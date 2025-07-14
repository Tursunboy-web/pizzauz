<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;

// Главная страница (каталог пицц)
Route::get('/', [PizzaController::class, 'index'])->name('home');
Route::post('/toggle-theme', function () {
    $current = session('theme', 'light');
    session(['theme' => $current === 'dark' ? 'light' : 'dark']);
    return back();
})->name('toggle.theme');

// Просмотр отдельной пиццы
Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('pizza.show');

// Оформление заказа
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// -------------------- Админка --------------------

Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {

    // Редирект с /admin на /admin/dashboard
    Route::get('/', fn() => redirect()->route('admin.dashboard'))->name('admin.index');

    Route::post('/admin/settings/save', [AdminController::class, 'saveSettings'])->name('admin.settings.save');


    // Главная страница админки
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Аналитика, настройки, баннеры
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings/save', [AdminController::class, 'saveSettings'])->name('admin.settings.save');
    Route::get('/banners', [AdminController::class, 'banners'])->name('admin.banners');
    Route::post('/banners/upload', [AdminController::class, 'uploadBanner'])->name('admin.banners.upload');

    // Управление пиццами
    Route::get('/pizzas', [AdminController::class, 'pizzas'])->name('admin.pizzas');
    Route::get('/pizzas/create', [AdminController::class, 'createPizza'])->name('admin.pizzas.create');
    Route::post('/pizzas', [AdminController::class, 'storePizza'])->name('admin.pizzas.store');
    Route::get('/pizzas/{pizza}/edit', [AdminController::class, 'editPizza'])->name('admin.pizzas.edit');
    Route::put('/pizzas/{pizza}', [AdminController::class, 'updatePizza'])->name('admin.pizzas.update');
    Route::delete('/pizzas/{pizza}', [AdminController::class, 'destroyPizza'])->name('admin.pizzas.destroy');

    // Заказы
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
});

// -------------------- Аутентификация --------------------

Auth::routes();

// Домашняя страница после входа (не обязательно, можешь убрать если не используешь)
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

