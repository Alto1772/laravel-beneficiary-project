<?php

namespace App\Imports;

use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Municipality;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str;

class BeneficiaryImport implements ToModel, WithHeadingRow, WithChunkReading
{
  protected Carbon $year;

  public function __construct(int $year = null)
  {
    $this->year = Carbon::createFromDate($year)->startOfYear();
  }

  public function chunkSize(): int
  {
    return 1000; // Import 1000 rows at a time
  }

  /**
   * @param array $row
   * @return Beneficiary
   */
  public function model(array $row)
  {
    // TODO move additional data creation logic. There should be a way to do this.
    $municipality = Municipality::firstOrCreate([
      'name' => Str::title($row['city_municipality']),
    ]);

    $barangay = Barangay::firstOrCreate([
      'name' => Str::title($row['barangay']),
      'municipality_id' => $municipality->id,
    ]);

    return new Beneficiary([
      'barangay_id' => $barangay->id,
      'age' => $row['age'],
      'created_at' => $this->year
    ]);
  }
}
