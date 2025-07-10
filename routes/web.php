<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::get('/', [PizzaController::class, 'index'])->name('home');
Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('pizza.show');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pizzas', [AdminController::class, 'pizzas'])->name('admin.pizzas');
    Route::get('/pizzas/create', [AdminController::class, 'createPizza'])->name('admin.pizzas.create');
    Route::post('/pizzas', [AdminController::class, 'storePizza'])->name('admin.pizzas.store');
    Route::get('/pizzas/{pizza}/edit', [AdminController::class, 'editPizza'])->name('admin.pizzas.edit');
Route::put('/pizzas/{pizza}', [AdminController::class, 'updatePizza'])->name('admin.pizzas.update');
Route::delete('/pizzas/{pizza}', [AdminController::class, 'destroyPizza'])->name('admin.pizzas.destroy');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
