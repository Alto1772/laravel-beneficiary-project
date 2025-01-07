<?php

namespace App\Http\Controllers\pages;

use App\Exports\BeneficiaryExport;
use App\Http\Controllers\Controller;
use App\Imports\BeneficiaryImport;
use App\Models\Project;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Str;

class ProjectController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $validatedData = $request->validate([
      'q' => 'nullable|string',
    ]);

    $searchTerm = $request->input('q');

    $projects = Project::with('beneficiaries')
      ->when($searchTerm, function ($query, $searchTerm) {
        $query->where('name', 'LIKE', "%{$searchTerm}%");
      })
      ->paginate(10)->withQueryString();

    if ($request->collect()->isEmpty() && $projects->isEmpty()) {
      return redirect()->route('projects.create');
    }

    return view('pages.projects.index', compact('projects'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pages.projects.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'location' => 'required|string',
      'datafile' => 'nullable|mimes:csv,xls,xlsx',
      'year' => 'required_if_accepted:datafile|integer|min:2019|max:' . date('Y'),
    ]);

    DB::transaction(function () use ($request, &$message) {
      $project = Project::create($request->only(['name', 'location']));
      $message = "Project {$project->name} created successfully";

      if (!$request->hasFile('datafile'))
        return;

      Excel::import(new BeneficiaryImport(project: $project), $request->file('datafile'));

      $count = $project->beneficiaries()->count();
      $message .= " with {$count} imported beneficiaries.";
    });

    return redirect()->route('projects.index')->with('success', $message);
  }

  /**
   * Display the specified resource.
   */
  public function show(Project $project)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Project $project)
  {
    return view('pages.projects.update', ['project' => $project]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Project $project)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'location' => 'required|string',
    ]);

    $project->update($validatedData);
    return redirect()->route('projects.index')->with('success', "Project {$project->name} updated successfully");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Project $project)
  {
    $project->delete();
    $project_name = $project->name;

    return redirect()->back()->with(['success' => "Project {$project_name} deleted successfully"]);
  }

  public function destroyWithBeneficiaries(Project $project)
  {
    $project->beneficiaries()->delete();
    $project->delete();
    $project_name = $project->name;

    return redirect()->back()->with(['success' => "Project {$project_name} and its beneficiaries successfully deleted"]);
  }

  public function exportToExcel(Project $project)
  {
    return Excel::download(new BeneficiaryExport(project: $project), 'beneficiaries-' . Str::slug($project->name) . '.xlsx');
  }
}
