<?php
// routes/api.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|──────────────────────────────────────────────────────────
| Base URL: /api/v1
|──────────────────────────────────────────────────────────
*/

Route::prefix('v1')->group(function () {

    /* ══════════════════════════════
       PUBLIC ROUTES
    ══════════════════════════════ */

    // Auth
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    // Services (public — anyone can browse)
    Route::get('/services',              [ServiceController::class, 'index']);
    Route::get('/entities/{id}',         [ServiceController::class, 'entity']);
    Route::get('/services/{id}',         [ServiceController::class, 'service']);

    /* ══════════════════════════════
       AUTHENTICATED ROUTES
    ══════════════════════════════ */
    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::post('/logout',           [AuthController::class, 'logout']);
        Route::get('/profile',           [AuthController::class, 'profile']);
        Route::put('/profile',           [AuthController::class, 'updateProfile']);
        Route::post('/profile/avatar',   [AuthController::class, 'uploadAvatar']);
        Route::put('/profile/password',  [AuthController::class, 'changePassword']);

        // Requests (user)
        Route::post('/requests',         [RequestController::class, 'store']);
        Route::get('/requests',          [RequestController::class, 'myRequests']);
        Route::get('/requests/{id}',     [RequestController::class, 'show']);

        // Payments (user)
        Route::post('/payments/charge',  [PaymentController::class, 'charge']);
        Route::get('/payments/history',  [PaymentController::class, 'history']);

        // User dashboard
        Route::get('/dashboard/user',    [DashboardController::class, 'userStats']);

        /* ══════════════════════════════
           ADMIN ONLY ROUTES
        ══════════════════════════════ */

        // Admin dashboard stats
        Route::get('/dashboard/admin',   [DashboardController::class, 'adminStats']);

        // Admin requests management
        Route::get('/admin/requests',              [RequestController::class, 'adminIndex']);
        Route::put('/admin/requests/{id}/status',  [RequestController::class, 'updateStatus']);
        Route::put('/admin/requests/{id}/time',    [RequestController::class, 'setEstimatedTime']);

        // Admin: manage services & pricing
        Route::post('/admin/categories',           [ServiceController::class, 'storeCategory']);
        Route::put('/admin/categories/{id}',       [ServiceController::class, 'updateCategory']);
        Route::delete('/admin/categories/{id}',    [ServiceController::class, 'destroyCategory']);

        Route::post('/admin/entities',             [ServiceController::class, 'storeEntity']);
        Route::put('/admin/entities/{id}',         [ServiceController::class, 'updateEntity']);
        Route::delete('/admin/entities/{id}',      [ServiceController::class, 'destroyEntity']);

        Route::post('/admin/services',             [ServiceController::class, 'storeService']);
        Route::put('/admin/services/{id}',         [ServiceController::class, 'updateService']);
        Route::put('/admin/services/{id}/price',   [ServiceController::class, 'updatePrice']);
        Route::delete('/admin/services/{id}',      [ServiceController::class, 'destroyService']);

        // Admin: users management
        Route::get('/admin/users',                 [AdminController::class, 'users']);
        Route::put('/admin/users/{id}/toggle',     [AdminController::class, 'toggleUser']);

        // Admin: financial transactions
        Route::get('/admin/payments',              [PaymentController::class, 'adminTransactions']);
    });
});
