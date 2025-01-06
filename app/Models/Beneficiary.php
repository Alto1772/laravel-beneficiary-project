<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
  use HasFactory;

  protected $fillable = ['first_name', 'last_name', 'middle_initial', 'barangay_id', 'age', 'number', 'created_at', 'project_id'];

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
   * Accessor for the 'name' attribute.
   *
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  public function name(): Attribute
  {
    return Attribute::make(
      get: fn() => $this->formatName(),
      set: fn($value) => ['first_name' => $value]
    );
  }

  /**
   * Scope a query to only include beneficiaries of a given year.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   * @param int $year
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOfYear($query, $year)
  {
    if ($year !== null) {
      return $query->whereYear('created_at', $year);
    } else {
      return $query;
    }
  }

  public function scopeWhereNameLike($query, $name)
  {
    return $query->where('first_name', 'LIKE', "%{$name}%")
      ->orWhere('last_name', 'LIKE', "%{$name}%")
      ->orWhere('middle_initial', 'LIKE', "%{$name}%");
  }
}
