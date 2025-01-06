<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Municipality;
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
      'project_id' => 'integer|exists:projects,id'
    ]);

    $searchTerm = $request->input('q');
    $barangayName = $request->input('barangay');
    $project_id = $request->input('project_id');
    $project_name = !empty($project_id) ? Project::find($project_id)->name : null;

    $builder = Beneficiary::with('barangay.municipality');

    // Get from this year
    $builder = $builder->ofYear(Carbon::now()->year);

    if (!empty($barangayName)) {
      $builder->whereHas('barangay', function ($query) use ($barangayName) {
        $query->where('name', $barangayName);
      });
    }

    if (!empty($searchTerm)) {
      $builder->where('name', 'LIKE', "%{$searchTerm}%");
      // ->orWhere('barangay.name', 'LIKE', "%{$searchTerm}%");
    }

    if (!empty($project_id)) {
      $builder->where('project_id', $project_id);
    }

    $data = $builder->paginate(15)->withQueryString();

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
      'municipality' => 'required|exists:municipalities,id',
      'age' => 'required|integer|min:1|max:200',
      'project_id' => 'nullable|exists:projects,id',
    ]);

    Beneficiary::create([
      'first_name' => $validatedData['first_name'],
      'last_name' => $validatedData['last_name'],
      'middle_initial' => $validatedData['middle_initial'],
      'barangay_id' => $validatedData['barangay'],
      'municipality_id' => $validatedData['municipality'],
      'project_id' => $validatedData['project_id'],
      'age' => $validatedData['age'],
      'year' => Carbon::now()->year,
    ]);

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
      'municipality' => 'required|exists:municipalities,id',
      'age' => 'required|integer|min:1|max:200',
    ]);

    $beneficiary = Beneficiary::findOrFail($id);
    $beneficiary->update([
      'first_name' => $validatedData['first_name'],
      'last_name' => $validatedData['last_name'],
      'middle_initial' => $validatedData['middle_initial'],
      'barangay_id' => $validatedData['barangay'],
      'municipality_id' => $validatedData['municipality'],
      'age' => $validatedData['age'],
    ]);

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
