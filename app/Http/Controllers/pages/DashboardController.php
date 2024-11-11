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

  private function getBarangayBeneficiaryCounts(int $year = null)
  {
    // Step 1: Create a subquery for distinct years
    $yearsSubquery = Beneficiary::select(DB::raw('DISTINCT YEAR(created_at) AS year'))
      ->ofYear($year);

    // Step 2: Perform cross join with barangays
    $results = Barangay::select(
      'barangays.name AS name',
      'years.year',
      DB::raw('COUNT(beneficiaries.id) AS count')
    )
      ->crossJoinSub($yearsSubquery, 'years')
      ->leftJoin('beneficiaries', function ($join) {
        $join->on('barangays.id', '=', 'beneficiaries.barangay_id')
          ->whereRaw('YEAR(beneficiaries.created_at) = years.year');
      })
      ->groupBy('barangays.name', 'years.year')
      ->orderBy('years.year')
      ->orderBy('barangays.name')
      ->get();

    return $results->groupBy('year');
  }

  private function getBeneficiaryAgeGroup(int $year = null)
  {
    $results = Beneficiary::select(DB::raw('YEAR(created_at) as year'), 'age', DB::raw('COUNT(*) as count'))
      ->ofYear($year)
      ->groupBy('year', 'age')
      ->orderBy('year')
      ->orderBy('age')
      ->get();

    return $results->groupBy('year');
  }

  public function analytics(Request $request)
  {
    $request->validate([
      'year' => 'nullable|integer|min:2000|max:' . date('Y'),
    ]);
    $year = $request->input('year');

    $barangays = $this->getBarangayBeneficiaryCounts($year);
    $ageGroups = $this->getBeneficiaryAgeGroup($year);

    return response()->json(compact('barangays', 'ageGroups'));
  }
}
