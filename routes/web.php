<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EncryptedsControllers;
use App\Models\FileLogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.logins');
});

Route::get('/login', [AuthController::class, 'viewLogin'])->name('logins');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {

    $today = now()->toDateString();

$totalToday = FileLogs::whereDate('created_at', $today)->count();
$totalEncrypted = FileLogs::where('type', 'encryption')->count();

$totalDecrypted = FileLogs::where('type', 'decryption')->count();
    $users = Auth::user();
    // dd($users);
    $logs = FileLogs::orderBy('created_at', 'desc')->take(10)->get();
    return view('pages.dashboard',  compact('totalToday', 'totalEncrypted', 'totalDecrypted', 'users', 'logs'));
})->middleware('auth');
Route::get('/enkripsi', function () {
    return view('pages.enkripsi');
});
Route::get('/dekripsi', function () {
    return view('pages.dekripsi');
});
Route::get('/logsss', function () {
    return view('pages.logsss');
});

Route::post('/encrypt', [EncryptedsControllers::class, 'encrypt']);
Route::post('/decrypt', [EncryptedsControllers::class, 'decrypt']);

