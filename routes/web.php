<?php

use App\Http\Controllers\pages\AccountSettingsController;
use App\Http\Controllers\pages\BeneficiaryController;
use App\Http\Controllers\pages\BarangayController;
use App\Http\Controllers\pages\DashboardController;
use App\Http\Controllers\pages\HistoricalController;
use App\Http\Controllers\pages\ProjectController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('page.home');
Route::view('/about', 'pages.about')->name('page.about');
Route::view('/services', 'pages.services')->name('page.services');
Route::view('/contact', 'pages.contact')->name('page.contact');
// Route::redirect('/', '/admin/dashboard');

Route::prefix('/api')->name('api.')->middleware(['api'])->group(function () {
  Route::get('/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');

  Route::middleware(['auth'])->group(function () {
    Route::post('/beneficiaries/update-name', [BeneficiaryController::class, 'updateName'])->name('beneficiary.updatename');

    Route::get('/barangays/list/{municipalityId}', [BarangayController::class, 'listBarangaysByMunicipality'])->name('barangay.list');
    Route::get('/municipalities/list', [BarangayController::class, 'listMunicipalities'])->name('municipality.list');

  });
});

Route::prefix('/admin')->group(function () {
  Route::redirect("/", "/admin/dashboard");

  Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => config('variables.canRegister', false),
    'reset' => false,
    'confirm' => false,
    'verify' => false,
  ]);

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

  Route::controller(BeneficiaryController::class)->middleware(['auth'])->group(function () {
    Route::get('/beneficiaries', 'index')->name('beneficiary.index');
    Route::get('/beneficiaries/create', 'pageAdd')->name('beneficiary.create');
    Route::post('/beneficiaries/add', 'add')->name('beneficiary.add');
    Route::get('/beneficiaries/edit/{id}', 'pageUpdate')->name('beneficiary.edit');
    Route::post('/beneficiaries/update/{id}', 'update')->name('beneficiary.update');
    Route::post('/beneficiaries/delete/{id}', 'delete')->name('beneficiary.delete');
  });

  Route::controller(BarangayController::class)->middleware(['auth'])->group(function () {
    Route::get('/barangays', 'index')->name('barangay.index');
  });

  Route::controller(HistoricalController::class)->middleware(['auth'/* , 'role:admin' */])->group(function () {
    Route::get('/history', 'index')->name('historical.index');
    Route::post('/history/import', 'importFromExcel')->name('historical.import');
    Route::get('/history/export', 'exportToExcel')->name('historical.export');
  });

  Route::controller(AccountSettingsController::class)->middleware(['auth'])->group(function () {
    Route::get('/account', 'index')->name('account.index');
    Route::post('/account/update/avatar', 'updateAvatar')->name('account.update.avatar');
    Route::post('/account/update/username', 'updateName')->name('account.update.username');
    Route::post('/account/update/password', 'updatePassword')->name('account.update.password');
  });

  Route::resource('/projects', ProjectController::class)->middleware(['auth'])->except(['show']);
  Route::controller(ProjectController::class)->middleware(['auth'])->group(function () {
    Route::get('/projects/{project}/export', 'exportToExcel')->name('projects.export');
    Route::delete('/projects/{project}/delete-all', 'deleteProjectAndBeneficiaries')->name('projects.deleteAll');
  });
});
