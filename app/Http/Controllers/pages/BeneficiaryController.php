<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BeneficiaryController extends Controller
{
  public function index(Request $request)
  {
    $validatedData = $request->validate([
      'barangay' => 'nullable|string|exists:barangays,name',
      'q' => 'nullable|string',
    ]);

    $searchTerm = $request->input('q');
    $barangayName = $request->input('barangay');

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

    $data = $builder->paginate(15)->withQueryString();

    return view('pages.beneficiaries.index', compact('data', 'barangayName', 'searchTerm'));
  }

  public function pageAdd()
  {
    return view('pages.beneficiaries.create');
  }

  public function pageUpdate(int $id)
  {
    $beneficiary = Beneficiary::with('barangay.municipality')->findOrFail($id);

    return view('pages.beneficiaries.update', compact('beneficiary'));
  }

  public function add(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'barangay' => 'required|exists:barangays,id',
      'municipality' => 'required|exists:municipalities,id',
      'age' => 'required|integer|min:1|max:200',
    ]);

    Beneficiary::create([
      'name' => $validatedData['name'],
      'barangay_id' => $validatedData['barangay'],
      'municipality_id' => $validatedData['municipality'],
      'age' => $validatedData['age'],
      'year' => Carbon::now()->year,
    ]);

    return redirect()->route('beneficiary.index')->with(['success' => 'Beneficiary added successfully']);
  }

  public function update(Request $request, int $id)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'barangay' => 'required|exists:barangays,id',
      'municipality' => 'required|exists:municipalities,id',
      'age' => 'required|integer|min:1|max:200',
    ]);

    $beneficiary = Beneficiary::findOrFail($id);
    $beneficiary->update([
      'name' => $validatedData['name'],
      'barangay_id' => $validatedData['barangay'],
      'municipality_id' => $validatedData['municipality'],
      'age' => $validatedData['age'],
    ]);

    return redirect()->route('beneficiary.index')->with(['success' => 'Beneficiary updated successfully']);
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

    return redirect()->route('beneficiary.index')->with(['success' => "Beneficiary {$beneficiary_name} deleted successfully"]);
  }
}
