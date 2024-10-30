<?php

use App\Http\Controllers\pages\AccountSettingsController;
use App\Http\Controllers\pages\BeneficiaryController;
use App\Http\Controllers\pages\BarangayController;
use App\Http\Controllers\pages\DashboardController;
use App\Http\Controllers\pages\HistoricalController;
use Illuminate\Support\Facades\Route;

// Route::fallback([MiscError::class, 'index']);
Route::redirect('/', '/dashboard');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/api/analytics', [DashboardController::class, 'analytics'])->name('api.dashboard.analytics');

Route::middleware(['auth'])->group(function () {
  Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiary.index');
  Route::get('/beneficiaries/create', [BeneficiaryController::class, 'pageAdd'])->name('beneficiary.create');
  Route::post('/beneficiaries/add', [BeneficiaryController::class, 'add'])->name('beneficiary.add');
  Route::get('/beneficiaries/edit/{id}', [BeneficiaryController::class, 'pageUpdate'])->name('beneficiary.edit');
  Route::post('/beneficiaries/update/{id}', [BeneficiaryController::class, 'update'])->name('beneficiary.update');
  Route::post('/beneficiaries/delete/{id}', [BeneficiaryController::class, 'delete'])->name('beneficiary.delete');
  Route::post('/api/beneficiaries/update-name', [BeneficiaryController::class, 'updateName'])->name('api.beneficiary.updatename');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/barangays', [BarangayController::class, 'index'])->name('barangay.index');
  Route::get('/api/barangays/list/{municipalityId}', [BarangayController::class, 'listBarangaysByMunicipality'])->name('api.barangay.list');
  Route::get('/api/municipalities/list', [BarangayController::class, 'listMunicipalities'])->name('api.municipality.list');
});

Route::middleware(['auth'/* , 'role:admin' */])->group(function () {
  Route::get('/history', [HistoricalController::class, 'index'])->name('historical.index');
  Route::post('/history/import', [HistoricalController::class, 'importFromExcel'])->name('historical.import');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/account', [AccountSettingsController::class, 'index'])->name('account.index');
  Route::post('/account/update/avatar', [AccountSettingsController::class, 'updateAvatar'])->name('account.update.avatar');
  Route::post('/account/update/username', [AccountSettingsController::class, 'updateName'])->name('account.update.username');
  Route::post('/account/update/password', [AccountSettingsController::class, 'updatePassword'])->name('account.update.password');
});
