<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  public function municipality()
  {
    return $this->belongsTo(Municipality::class);
  }

  public function beneficiaries()
  {
    return $this->hasMany(Beneficiary::class);
  }
}
