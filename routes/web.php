<?php

// Author: Emily Cardona Castañeda

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PlantController as AdminPlantController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ───────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::post('/locale', [LocaleController::class, 'switch'])->name('locale.switch');

Route::prefix('plants')->group(function () {
    Route::get('/', [PlantController::class, 'index'])->name('plant.index');
    Route::get('/{plant}', [PlantController::class, 'show'])->name('plant.show');
});

Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('service.index');
});

// ─── AUTH ─────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ─── AUTHENTICATED USER ───────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::put('/update/{plant}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove/{plant}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
        Route::delete('/remove-service/{serviceId}', [CartController::class, 'removeService'])->name('cart.remove.service');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
        Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('order.show');
    });
});

// ─── ADMIN ────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'checkAdmin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        // Plants
        Route::prefix('plants')->group(function () {
            Route::get('/', [AdminPlantController::class, 'index'])->name('admin.plant.index');
            Route::get('/create', [AdminPlantController::class, 'create'])->name('admin.plant.create');
            Route::post('/', [AdminPlantController::class, 'store'])->name('admin.plant.store');
            Route::get('/{plant}/edit', [AdminPlantController::class, 'edit'])->name('admin.plant.edit');
            Route::put('/{plant}', [AdminPlantController::class, 'update'])->name('admin.plant.update');
            Route::delete('/{plant}', [AdminPlantController::class, 'destroy'])->name('admin.plant.destroy');
        });

        // Categories
        Route::prefix('categories')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category.index');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
            Route::post('/', [AdminCategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        // Services
        Route::prefix('services')->group(function () {
            Route::get('/', [AdminServiceController::class, 'index'])->name('admin.service.index');
            Route::get('/create', [AdminServiceController::class, 'create'])->name('admin.service.create');
            Route::post('/', [AdminServiceController::class, 'store'])->name('admin.service.store');
            Route::get('/{service}/edit', [AdminServiceController::class, 'edit'])->name('admin.service.edit');
            Route::put('/{service}', [AdminServiceController::class, 'update'])->name('admin.service.update');
            Route::delete('/{service}', [AdminServiceController::class, 'destroy'])->name('admin.service.destroy');
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin.order.index');
            Route::get('/{order}/edit', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
            Route::put('/{order}', [AdminOrderController::class, 'update'])->name('admin.order.update');
        });

        // Users
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.index');
            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
        });
    });
