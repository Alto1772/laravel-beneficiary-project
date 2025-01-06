<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BarangayController extends Controller
{
  public function index(Request $request)
  {
    // $request->validate([
    //   'year' => 'nullable|integer|min:2019|max:' . date('Y'),
    // ]);
    // $year = $request->input('year', Carbon::now()->year);
    $year = Carbon::now()->year;

    $data = Barangay::withCount([
      'beneficiaries' => function ($query) use ($year) {
        $query->ofYear($year);
      }
    ])
      ->withMin([
        'beneficiaries' => function ($query) use ($year) {
          $query->ofYear($year);
        }
      ], 'age')
      ->withMax([
        'beneficiaries' => function ($query) use ($year) {
          $query->ofYear($year);
        }
      ], 'age')
      ->having('beneficiaries_count', '>', 0)
      ->orderBy('name', 'asc')
      ->paginate()->withQueryString();

    return view('pages.barangays.index', compact('data', 'year'));
  }

  public function listBarangaysByMunicipality(int $municipalityId)
  {
    $barangays = Barangay::where('municipality_id', $municipalityId)->select(['id', 'name'])->get();

    return response()->json(compact('barangays'));
  }

  public function listMunicipalities()
  {
    $municipalities = Municipality::select(['id', 'name'])->get();

    return response()->json(compact('municipalities'));
  }
}
