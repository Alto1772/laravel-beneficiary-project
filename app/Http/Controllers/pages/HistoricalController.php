<?php

namespace App\Http\Controllers\pages;

use App\Exports\BeneficiaryExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Imports\BeneficiaryImport;
use Illuminate\Validation\Rules\File;
use Maatwebsite\Excel\Facades\Excel;

class HistoricalController extends Controller
{

  public function index(Request $request)
  {
    $validatedData = $request->validate([
      'year' => 'nullable|integer|min:2019|max:' . date('Y'),
      'barangay' => 'nullable|string|exists:barangays,name',
      'q' => 'nullable|string',
      'project_id' => 'nullable|integer|exists:projects,id'
    ]);

    $year = $request->input('year');
    $searchTerm = $request->input('q');
    $barangayName = $request->input('barangay');
    $project_id = $request->input('project_id');

    $data = Beneficiary::with('barangay.municipality')
      ->when($year, function ($query, $year) {
        $query->ofYear($year);
      })
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
      ->orderBy('created_at', 'DESC')
      ->orderBy('barangay_id', 'ASC')
      ->paginate(50)->withQueryString();

    return view('pages.historical.index', compact('data', 'year', 'searchTerm', 'barangayName'));
  }

  public function importFromExcel(Request $request)
  {
    $request->validate([
      'dataset' => ['required', File::types(['csv', 'xls', 'xlsx'])->max('1mb')],
      'year' => ['required', 'integer', 'min:2019', 'max:' . date('Y')],
    ], [
      'dataset.mimes' => 'Dataset must be in a CSV, Excel XLS & XLSX format',
    ]);

    Excel::import(new BeneficiaryImport($request->get('year')), $request->file('dataset'));

    return redirect()->back()->with(['success' => 'Data Imported successfully']);
  }

  public function exportToExcel(Request $request)
  {
    $request->validate([
      'year' => ['nullable', 'integer', 'min:2019', 'max:' . date('Y')],
    ]);
    $year = $request->get('year');

    return Excel::download(new BeneficiaryExport($year), 'beneficiaries-' . ($year ?? 'all') . '.xlsx');
  }
}
