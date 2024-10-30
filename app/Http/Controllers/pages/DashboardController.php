<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Models\Barangay;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    return view('pages.dashboard');
  }

  public function analytics(Request $request)
  {
    $request->validate([
      'year' => 'nullable|integer|min:2000|max:' . date('Y'),
    ]);
    $year = $request->input('year');

    // $barangays = Barangay::select('name')->withCount([
    //   'beneficiaries as count' => function ($query) use ($year) {
    //     $query->ofYear($year);
    //   }
    // ])
    //   ->orderBy('name', 'asc')
    //   ->get();

    /// THIS CODE IS PURE SHIT!!!!!!!!  PLEASE REPLACE IMMEDIATELY
    $barangays = Barangay::select('barangays.name', DB::raw('YEAR(beneficiaries.created_at) as year'))
      ->leftJoin('beneficiaries', 'barangays.id', '=', 'beneficiaries.barangay_id')
      ->selectRaw('COUNT(beneficiaries.id) as count')
      ->groupBy('barangays.name', 'year')
      ->orderBy('year')
      ->orderBy('barangays.name')
      ->get()
      ->groupBy('year')
      ->map(function ($yearGroup) {
        return $yearGroup->map(function ($item) {
          return [
            'name' => $item->name,
            'count' => (int) $item->count
          ];
        })->values();
      });


    $ageGroups = Beneficiary::select(DB::raw('YEAR(created_at) as year'), 'age', DB::raw('COUNT(*) as count'))
      ->ofYear($year)
      ->groupBy('year', 'age')
      ->orderBy('year')
      ->orderBy('age')
      ->get()
      ->groupBy('year');
    return response()->json(compact('barangays', 'ageGroups'));
  }
}
