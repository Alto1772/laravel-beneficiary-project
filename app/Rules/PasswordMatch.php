<?php

namespace App\Rules;

use Closure;
use Hash;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordMatch implements ValidationRule
{
  /**
   * Run the validation rule.
   *
   * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $user = auth()->user();

    if (!Hash::check($value, $user->password)) {
      $fail('Current password does not match.');
    }
  }
}
