<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'barangay_id', 'age', 'number', 'created_at'];

  public function barangay()
  {
    return $this->belongsTo(Barangay::class);
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
}
