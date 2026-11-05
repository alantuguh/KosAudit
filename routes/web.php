<?php

use App\Http\Controllers\Web\WorkspaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [WorkspaceController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.post');
Route::post('/logout', [WorkspaceController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// UI Playground (khusus environment lokal)
if (app()->environment('local')) {
    Route::view('/dev/ui-kit', 'dev.ui-kit')->name('dev.ui-kit');
    Route::view('/dev/ui-kit/components', 'dev.components')->name('dev.components');
}

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/', [WorkspaceController::class, 'dashboard'])->name('dashboard');

    Route::get('/kamar', [WorkspaceController::class, 'rooms'])->name('kamar.index');
    Route::post('/kamar', [WorkspaceController::class, 'storeRoom'])->name('kamar.store');
    Route::get('/kamar/{nomor}', [WorkspaceController::class, 'room'])->name('kamar.show');

    Route::get('/penghuni', [WorkspaceController::class, 'tenants'])->name('penghuni.index');
    Route::post('/penghuni', [WorkspaceController::class, 'storeTenant'])->name('penghuni.store');

    Route::get('/sewa', function () {
        $sewaList = [
            ['kode' => 'SEWA-2024-104', 'penghuni' => 'Dinda Kirana', 'kamar' => '104', 'periode' => '1 Jun 2024 – 24 Mei 2025', 'deposit' => 'Rp 500.000', 'status_deposit' => 'Menunggu Verifikasi'],
            ['kode' => 'SEWA-2024-101', 'penghuni' => 'Anisa Rahmawati', 'kamar' => '101', 'periode' => '15 Jan 2024 – 15 Jan 2025', 'deposit' => 'Rp 500.000', 'status_deposit' => 'Terisi'],
            ['kode' => 'SEWA-2024-202', 'penghuni' => 'Budi Wicaksono', 'kamar' => '202', 'periode' => '22 Mei 2025 – 22 Mei 2026', 'deposit' => 'Rp 750.000', 'status_deposit' => 'Disetujui Penghuni'],
            ['kode' => 'SEWA-2024-205', 'penghuni' => 'Melisa Putri', 'kamar' => '205', 'periode' => '15 Mei 2024 – 15 Mei 2025', 'deposit' => 'Rp 500.000', 'status_deposit' => 'Ada Keberatan'],
        ];

        return view('sewa.index', compact('sewaList'));
    })->name('sewa.index');

    Route::post('/sewa', function (Request $request) {
        $request->validate([
            'penghuni' => 'required|string',
            'kamar' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'nominal_deposit' => 'required|numeric|min:0',
        ]);

        return redirect()->route('sewa.index')
            ->with('warning', 'Modul transaksi sewa belum tersedia pada backend yang terhubung; kontrak belum disimpan.');
    })->name('sewa.store');

    Route::get('/inspeksi/form', fn() => view('inspeksi.form'))->name('inspeksi.create');
    Route::post('/inspeksi/form', function (Request $request) {
        return redirect()->route('inspeksi.create')
            ->with('warning', 'Modul inspeksi belum tersedia pada backend yang terhubung; data belum disimpan.');
    })->name('inspeksi.store');
    Route::get('/inspeksi/komparasi', fn() => view('inspeksi.komparasi'))->name('inspeksi.komparasi');

    Route::get('/deposit/perhitungan', fn() => view('deposit.perhitungan'))->name('deposit.perhitungan');
});

Route::middleware(['auth', 'role:tenant'])->group(function () {
    Route::get('/portal-penghuni', fn() => view('portal-penghuni.dashboard'))->name('portal.dashboard');
    Route::get('/m/beranda', fn() => view('portal-penghuni.mobile-beranda'))->name('mobile.beranda');
    Route::get('/m/kondisi', fn() => view('portal-penghuni.mobile-kondisi'))->name('mobile.kondisi');
    Route::get('/m/deposit', fn() => view('portal-penghuni.mobile-deposit'))->name('mobile.deposit');
});
