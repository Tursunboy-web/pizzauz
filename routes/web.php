<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware; // Подключаем middleware напрямую

// Главная страница (каталог пицц)
Route::get('/', [PizzaController::class, 'index'])->name('home');

// Просмотр отдельной пиццы
Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('pizza.show');

// Оформление заказа
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// Админка (только для авторизованных админов)
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
Route::post('/settings/save', [AdminController::class, 'saveSettings'])->name('admin.settings.save');
Route::get('/banners', [AdminController::class, 'banners'])->name('admin.banners');
Route::post('/banners/upload', [AdminController::class, 'uploadBanner'])->name('admin.banners.upload');


    // ✅ Редирект с /admin на /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('admin.index');

    // Главная страница админки
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Управление пиццами
    Route::get('/pizzas', [AdminController::class, 'pizzas'])->name('admin.pizzas');
    Route::get('/pizzas/create', [AdminController::class, 'createPizza'])->name('admin.pizzas.create');
    Route::post('/pizzas', [AdminController::class, 'storePizza'])->name('admin.pizzas.store');
    Route::get('/pizzas/{pizza}/edit', [AdminController::class, 'editPizza'])->name('admin.pizzas.edit');
    Route::put('/pizzas/{pizza}', [AdminController::class, 'updatePizza'])->name('admin.pizzas.update');
    Route::delete('/pizzas/{pizza}', [AdminController::class, 'destroyPizza'])->name('admin.pizzas.destroy');

    // Управление заказами
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
});

// Авторизация и регистрация (готовые маршруты Laravel)
Auth::routes();

// Домашняя страница (после входа)
Route::get('/home', [HomeController::class, 'index'])->name('home');
