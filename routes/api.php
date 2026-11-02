<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\Owner\MasterItemController;
use App\Http\Controllers\Api\Owner\RoomController;
use App\Http\Controllers\Api\Owner\TenantController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route model binding
|--------------------------------------------------------------------------
| {tenant} hanya me-resolve user ber-role tenant. ID milik Owner → 404.
*/
Route::bind('tenant', fn (string $value) => User::tenants()->findOrFail($value));

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->name('auth.')->group(function () {
    // Maks. 5 percobaan login per menit per IP, mencegah brute force.
    Route::post('login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('me', [AuthController::class, 'me'])->name('me');

        // Register penghuni hanya bisa dilakukan Owner.
        Route::post('register', [AuthController::class, 'register'])
            ->middleware('role:owner')
            ->name('register');
    });
});

/*
|--------------------------------------------------------------------------
| Area Owner
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'owner'])->name('dashboard');

        // Master data
        Route::apiResource('rooms', RoomController::class);
        Route::apiResource('master-items', MasterItemController::class);
        Route::apiResource('tenants', TenantController::class);
    });

/*
|--------------------------------------------------------------------------
| Area Penghuni (Tenant)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:tenant'])
    ->prefix('tenant')
    ->name('tenant.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'tenant'])->name('dashboard');
    });
