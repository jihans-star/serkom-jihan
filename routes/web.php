<?php

use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])
    ->name('landing');

Route::get('/profil', [LandingPageController::class, 'profil'])->name('profil');


Route::get('/guru', [LandingPageController::class, 'guru'])->name('guru');
Route::get('/guru/{id}', [LandingPageController::class, 'detailGuru'])->name('guru.detail');

Route::get('/ekstrakurikuler', [LandingPageController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
Route::get('/ekstrakurikuler{id}', [LandingPageController::class, 'detailEkstrakurikuler'])->name('ekstrakurikuler.detail');

Route::get('/prestasi-sekolah', [LandingPageController::class, 'prestasi'])->name('prestasi');
Route::get('/prestasi-sekolah/{id}', [LandingPageController::class, 'detailPrestasi'])->name('prestasi.detail');

Route::get('/galeri', [LandingPageController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [LandingPageController::class, 'detailGaleri'])->name('galeri.detail');

Route::get('/berita', [LandingPageController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [LandingPageController::class, 'detailBerita'])->name('berita.detail');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.show');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.index');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::resource('administrator/user', UserController::class)
        ->names('admin.user');

    Route::patch('/user/{user}/status', [UserController::class, 'toggleStatus'])
        ->name('admin.user.status');

    Route::get('administrator/sekolah', [ProfilSekolahController::class, 'index'])->name('admin.sekolah.index');
    Route::put('administrator/sekolah/update', [ProfilSekolahController::class, 'update'])->name('admin.sekolah.update');

    Route::resource('administrator/guru', GuruController::class)
        ->names('admin.guru');

    Route::resource('administrator/siswa', SiswaController::class)
        ->names('admin.siswa');

    Route::post('administrator/siswa/import', [SiswaController::class,'import'])
        ->name('admin.siswa.import');

    Route::resource('administrator/berita', BeritaController::class)
        ->names('admin.berita')->parameters(['berita' => 'berita']);

    Route::resource('administrator/galeri', GaleriController::class)
        ->names('admin.galeri');

    Route::resource('administrator/ekstrakurikuler', EkstrakurikulerController::class)
        ->names('admin.ekstrakurikuler');

    Route::resource('prestasi', PrestasiController::class)->names('admin.prestasi');

    Route::middleware('only_admin')->group(function () {
        Route::resource('administrator/user', UserController::class)->names('admin.user');
    });
});
