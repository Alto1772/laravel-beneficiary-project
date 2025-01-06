<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

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

    $builder = Project::query();
    if (!empty($searchTerm)) {
      $builder = Project::where('name', 'LIKE', "%{$searchTerm}%");
    }

    $projects = $builder->paginate(10)->withQueryString();

    if ($projects->isEmpty()) {
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
    ]);

    $project = Project::create($validatedData);
    return redirect()->route('projects.index')->with('success', "Project {$project->name} created successfully");
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
}
