<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BeneficiaryController extends Controller
{
  public function index(Request $request)
  {
    $validatedData = $request->validate([
      'barangay' => 'nullable|string|exists:barangays,name',
      'q' => 'nullable|string',
      'project_id' => 'nullable|integer|exists:projects,id'
    ]);

    $searchTerm = $request->input('q');
    $barangayName = $request->input('barangay');
    $project_id = $request->input('project_id');
    $currentYear = Carbon::now()->year;

    $data = Beneficiary::with(['barangay.municipality', 'project'])
      ->ofYear($currentYear)
      ->when($barangayName, function ($query, $barangayName) {
        $query->whereHas('barangay', function ($query) use ($barangayName) {
          $query->where('name', $barangayName);
        });
      })
      ->when($searchTerm, function ($query, $searchTerm) {
        $query->whereNameLike($searchTerm);
      })
      ->when($project_id, function ($query, $project_id) {
        $query->where('project_id', $project_id);
      })
      ->paginate(15)->withQueryString();

    $project_name = !empty($project_id) ? Project::find($project_id)->name : null;

    return view('pages.beneficiaries.index', compact('data', 'barangayName', 'searchTerm', 'project_name'));
  }

  public function pageAdd(Request $request)
  {
    $request->session()->put('previousPage', url()->previous());

    return view('pages.beneficiaries.create');
  }

  public function pageUpdate(Request $request, int $id)
  {
    $request->session()->put('previousPage', url()->previous());

    $beneficiary = Beneficiary::with('barangay.municipality')->findOrFail($id);

    return view('pages.beneficiaries.update', compact('beneficiary'));
  }

  public function add(Request $request)
  {
    $validatedData = $request->validate([
      'first_name' => 'required|string|max:255',
      'last_name' => 'nullable|string|max:20',
      'middle_initial' => 'nullable|string|max:5',
      'barangay' => 'required|exists:barangays,id',
      'age' => 'required|integer|min:1|max:200',
      'project_id' => 'nullable|exists:projects,id',
    ]);

    $beneficiary = new Beneficiary([
      'first_name' => $validatedData['first_name'],
      'last_name' => $validatedData['last_name'],
      'middle_initial' => $validatedData['middle_initial'],
      'age' => $validatedData['age'],
    ]);

    $beneficiary->barangay()->associate($validatedData['barangay']);
    if (isset($validatedData['project_id']))
      $beneficiary->project()->associate($validatedData['project_id']);
    $beneficiary->save();

    return redirect($request->session()->get('previousPage', route('beneficiary.index')))
      ->with(['success' => 'Beneficiary added successfully']);
  }

  public function update(Request $request, int $id)
  {
    $validatedData = $request->validate([
      'first_name' => 'required|string|max:255',
      'last_name' => 'nullable|string|max:20',
      'middle_initial' => 'nullable|string|max:5',
      'barangay' => 'required|exists:barangays,id',
      'age' => 'required|integer|min:1|max:200',
    ]);

    $beneficiary = Beneficiary::findOrFail($id);
    $beneficiary->fill([
      'first_name' => $validatedData['first_name'],
      'last_name' => $validatedData['last_name'],
      'middle_initial' => $validatedData['middle_initial'],
      'age' => $validatedData['age'],
    ]);
    $beneficiary->barangay()->associate($validatedData['barangay']);
    $beneficiary->save();

    return redirect($request->session()->get('previousPage', route('beneficiary.index')))
      ->with(['success' => 'Beneficiary updated successfully']);
  }
  public function updateName(Request $request)
  {
    $validatedData = $request->validate([
      'id' => 'required|exists:beneficiaries,id',
      'name' => 'required|string|max:255',
    ]);

    Beneficiary::findOrFail($validatedData['id'])
      ->update(['name' => $validatedData['name']]);

    return response()->json(['success' => 'Beneficiary Name changed successfully']);
  }

  public function delete(int $id)
  {
    $beneficiary = Beneficiary::findOrFail($id);
    $beneficiary->delete();

    $beneficiary_name = $beneficiary->name ?? 'Unknown';

    return redirect()->back()->with(['success' => "Beneficiary {$beneficiary_name} deleted successfully"]);
  }
}
