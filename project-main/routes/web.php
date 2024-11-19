<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user-profile');
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    // Route::get('/register', [RegisterController::class, 'create']);
    // Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	// Route::get('/login/forgot-password', [ResetController::class, 'create']);
	// Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	// Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	// Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');

//pasien
Route::resource('patients', PatientController::class);
Route::resource('claims', ClaimController::class);

Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');

//new
Route::resource('claims', ClaimController::class);

Route::get('/api/patients/search/{no_rm}', [PatientController::class, 'search']);
Route::post('/api/patients/check-limit', [PatientController::class, 'checkLimit'])->name('patients.check-limit');

// Route untuk menampilkan halaman
Route::get('/user-management', [PatientController::class, 'index'])->name('user-management');

// Route untuk API cek limit
Route::post('/api/patients/check-limit', [PatientController::class, 'checkLimit']);

Route::post('/patients/check-limit', [PatientController::class, 'checkLimit'])->name('patients.check-limit');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/get-patient-name/{no_rm}', function($no_rm) {
    $patient = DB::table('claims')
        ->where('no_rm', $no_rm)
        ->select('nama_lengkap')
        ->first();
    
    return response()->json([
        'nama_lengkap' => $patient ? $patient->nama_lengkap : null
    ]);
});

Route::get('/patient-detail/{no_rm}', [DashboardController::class, 'getPatientDetail']);

Route::post('/hitung-klaim', [ClaimController::class, 'hitungKlaim'])->name('hitung.klaim');


