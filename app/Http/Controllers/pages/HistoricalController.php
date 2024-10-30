<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Imports\BeneficiaryImport;
use Illuminate\Validation\Rules\File;
use Excel;

class HistoricalController extends Controller
{

  public function index(Request $request)
  {
    $validatedData = $request->validate([
      'year' => 'nullable|integer|min:2000|max:' . date('Y'),
      'barangay' => 'nullable|string|exists:barangays,name',
      'q' => 'nullable|string',
    ]);

    $year = $request->input('year');
    $searchTerm = $request->input('q');
    $barangayName = $request->input('barangay');

    $builder = Beneficiary::with('barangay.municipality');

    if (!empty($year)) {
      $builder = $builder->ofYear($year);
    }

    if (!empty($barangayName)) {
      $builder->whereHas('barangay', function ($query) use ($barangayName) {
        $query->where('name', $barangayName);
      });
    }

    if (!empty($searchTerm)) {
      $builder->where('name', 'LIKE', "%{$searchTerm}%");
      // ->orWhere('barangay.name', 'LIKE', "%{$searchTerm}%");
    }

    $builder->orderBy('created_at', 'DESC')->orderBy('barangay_id', 'ASC');
    $data = $builder->paginate(50)->withQueryString();

    return view('pages.historical.index', compact('data', 'year', 'searchTerm', 'barangayName'));
  }

  public function importFromExcel(Request $request)
  {
    $request->validate([
      'dataset' => ['required', File::types(['csv', 'xls', 'xlsx'])->max('1mb')],
      'year' => ['required', 'integer', 'min:2000', 'max:' . date('Y')],
    ], [
      'dataset.mimes' => 'Dataset must be in a CSV, Excel XLS & XLSX format',
    ]);

    Excel::import(new BeneficiaryImport($request->get('year')), $request->file('dataset'));

    return redirect()->back()->with(['success' => 'Data Imported successfully']);
  }
}
