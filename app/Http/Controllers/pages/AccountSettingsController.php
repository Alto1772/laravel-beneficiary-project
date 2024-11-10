<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Rules\PasswordMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Storage;

class AccountSettingsController extends Controller
{
  public function index()
  {
    $name = Auth::user()->name;
    $role = Auth::user()->role;

    return view('pages.account-settings', compact('name', 'role'));
  }

  /**
   * Update the user's name.
   */
  public function updateName(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $user = Auth::user();
    $user->name = $request->name;
    $user->save();

    return redirect()->back()->with('success', 'Name updated successfully.');
  }

  /**
   * Update the user's password.
   */
  public function updatePassword(Request $request)
  {
    $request->validate([
      'current_password' => ['required', 'string', new PasswordMatch],
      'password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('success', 'Password updated successfully.');
  }

  /**
   * Update the user's avatar.
   */
  public function updateAvatar(Request $request)
  {
    $request->validate([
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('avatar')) {
      // Delete old avatar if exists
      if ($user->avatar) {
        Storage::delete("public/{$user->avatar}");
      }

      $path = $request->file('avatar')->store('avatars', 'public');
      $user->avatar = $path;
      $user->save();
    }

    return redirect()->back()->with('success', 'Avatar updated successfully.');
  }
}
