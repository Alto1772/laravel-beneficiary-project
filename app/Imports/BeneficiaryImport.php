<?php

namespace App\Imports;

use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Municipality;
use App\Models\Project;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Str;

class BeneficiaryImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation, WithBatchInserts
{
  private ?Carbon $year;
  private ?Project $project;
  // for caching purposes
  private Collection $municipalities;
  private Collection $barangays;

  public function __construct(int $year = null, Project $project = null)
  {
    $this->year = !empty($year) ? Carbon::createFromDate($year)->startOfYear() : null;
    $this->project = $project;
    $this->municipalities = Municipality::all()->keyBy(function ($item) {
      return Str::title($item->name);
    });
    $this->barangays = Barangay::with('municipality')->get()->keyBy(function ($item) {
      return Str::title($item->name) . '-' . $item->municipality_id;
    });
  }

  public function chunkSize(): int
  {
    return 1000;
  }

  public function batchSize(): int
  {
    return 500;
  }

  public function rules(): array
  {
    return [
      '*.name' => 'nullable|string|max:255',
      '*.age' => 'required|integer|min:0',
      '*.barangay' => 'required|string|max:255',
      '*.city_municipality' => 'required_without:*.municipality|string|max:255',
      '*.municipality' => 'required_without:*.city_municipality|string|max:255',
    ];
  }

  public function model(array $row): Beneficiary
  {
    $municipalityName = Str::title(trim($row['city_municipality'] ?? $row['municipality']));
    $municipality = $this->municipalities->get($municipalityName);

    if (!$municipality) {
      $municipality = Municipality::create(['name' => $municipalityName]);
      $this->municipalities->put($municipalityName, $municipality);
    }

    $barangayName = Str::title(trim($row['barangay']));
    $barangayKey = "{$barangayName}-{$municipality->id}";
    $barangay = $this->barangays->get($barangayKey);

    if (!$barangay) {
      $barangay = $municipality->barangays()->create(['name' => $barangayName]);
      $this->barangays->put($barangayKey, $barangay);
    }

    $beneficiary = $barangay->beneficiaries()->make([
      'age' => $row['age'],
      'name' => isset($row['name']) ? Str::title($row['name']) : null,
    ]);

    $beneficiary->created_at = $this->year ?? Carbon::now();

    if ($this->project !== null) {
      $beneficiary->project()->associate($this->project);
    }

    return $beneficiary;
  }
}
