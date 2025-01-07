<?php

namespace App\Imports;

use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Municipality;
use App\Models\Project;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str;

class BeneficiaryImport implements ToModel, WithHeadingRow, WithChunkReading
{
  private ?Carbon $year;
  private ?Project $project;

  public function __construct(int $year = null, Project $project = null)
  {
    $this->year = !empty($year) ? Carbon::createFromDate($year)->startOfYear() : null;
    $this->project = $project;
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
      'name' => Str::title($row['city_municipality'] ?? $row['municipality']),
    ]);

    $barangay = Barangay::firstOrCreate([
      'name' => Str::title($row['barangay']),
      'municipality_id' => $municipality->id,
    ]);

    $beneficiary = new Beneficiary();
    $beneficiary['barangay_id'] = $barangay->id;
    $beneficiary['age'] = $row['age'];
    if ($this->year !== null) {
      $beneficiary['created_at'] = $this->year;
    }
    if ($this->project !== null) {
      $beneficiary['project_id'] = $this->project->id;
    }
    if (isset($row['name'])) {
      $beneficiary['name'] = Str::title($row['name']);
    }

    return $beneficiary;
  }
}
