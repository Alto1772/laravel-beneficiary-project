<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
  use HasFactory;

  protected $fillable = [
    'first_name',
    'last_name',
    'middle_initial',
    'age',
    'number',
  ];

  public function barangay()
  {
    return $this->belongsTo(Barangay::class);
  }

  public function project()
  {
    return $this->belongsTo(Project::class);
  }

  /**
   * Format the beneficiary's full name.
   *
   * @return string|null
   */
  private function formatName(): ?string
  {
    if (empty($this->first_name)) {
      return null;
    }

    if (empty($this->last_name)) {
      return $this->first_name;
    }

    return trim("{$this->last_name}, {$this->first_name} {$this->middle_initial}");
  }

  /**
   * Parse and validate a formatted beneficiary name.
   *
   * @param string $name
   * @return array|null Returns array with parsed name components or null if invalid
   */
  private static function parseName(string $name): array
  {
    $name = trim($name);

    if (preg_match('/^([^,]+),\s*([^,]+?)\s*(?:\s+(\w+.?))?$/', $name, $matches)) {
      return [
        'last_name' => trim($matches[1]),
        'first_name' => trim($matches[2]),
        'middle_initial' => isset($matches[3]) ? trim($matches[3]) : null
      ];
    } else {
      return [
        'first_name' => $name,
      ];
    }
  }

  /**
   * Accessor for the 'name' attribute.
   *
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  public function name(): Attribute
  {
    return Attribute::make(
      get: fn() => $this->formatName(),
      set: fn($value) => self::parseName($value),
    );
  }

  /**
   * Scope a query to only include beneficiaries of a given year.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   * @param int $year
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOfYear(Builder $query, ?int $year)
  {
    return $query->when($year, function (Builder $query, $year) {
      $query->whereYear('created_at', $year);
    });
  }

  public function scopeWhereNameLike(Builder $query, string $name)
  {
    return $query->where('first_name', 'LIKE', "%{$name}%")
      ->orWhere('last_name', 'LIKE', "%{$name}%")
      ->orWhere('middle_initial', 'LIKE', "%{$name}%");
  }
}
