<?php

namespace App\Exports;

use App\Models\Beneficiary;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class BeneficiaryExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
  private Carbon|null $year;

  public function __construct(int $year = null)
  {
    $this->year = $year !== null ? Carbon::createFromDate($year)->startOfYear() : null;
  }

  public function query()
  {
    $builder = Beneficiary::query()->with('barangay.municipality');
    if (!$this->year !== null) {
      $builder->ofYear($this->year);
    }

    return $builder;
  }

  public function headings(): array
  {
    $headings = [
      'Name',
      'Barangay',
      'Municipality',
      'Age',
      'Year Added',
    ];

    if ($this->year !== null) {
      array_pop($headings);
    }
    return $headings;
  }

  public function map($beneficiary): array
  {
    $columns = [
      $beneficiary->name,
      $beneficiary->barangay->name,
      $beneficiary->barangay->municipality->name,
      $beneficiary->age,
      $beneficiary->created_at->year,
    ];

    if ($this->year !== null) {
      array_pop($columns);
    }
    return $columns;
  }

  public function styles($sheet): array
  {
    return [
      // Style the first row as bold text.
      1 => ['font' => ['bold' => true]],
    ];
  }
}
