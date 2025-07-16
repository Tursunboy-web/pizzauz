<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Middleware\AdminMiddleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// -------------------- 🔰 Public (Foydalanuvchilar uchun) --------------------

Route::get('/', [PizzaController::class, 'index'])->name('home');
Route::get('/pizza/{id}', [PizzaController::class, 'show'])->name('pizza.show');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::post('/toggle-theme', function () {
    $current = session('theme', 'light');
    session(['theme' => $current === 'dark' ? 'light' : 'dark']);
    return back();
})->name('toggle.theme');

// -------------------- 🔐 Authentication --------------------

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/home', [HomeController::class, 'index'])->name('home'); // optional
});

// -------------------- 🛠 Admin Panel --------------------

Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', fn() => redirect()->route('admin.dashboard'))->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Analytics, Settings, Banners
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings/save', [AdminController::class, 'saveSettings'])->name('settings.save');
    Route::get('/banners', [AdminController::class, 'banners'])->name('banners');
    // Удали, если не используешь:
    // Route::post('/banners/upload', [AdminController::class, 'uploadBanner'])->name('banners.upload');

    // 🍕 Pizza CRUD
    Route::get('/pizzas', [AdminController::class, 'pizzas'])->name('pizzas');
    Route::get('/pizzas/create', [AdminController::class, 'createPizza'])->name('pizzas.create');
    Route::post('/pizzas', [AdminController::class, 'storePizza'])->name('pizzas.store');
    Route::get('/pizzas/{pizza}/edit', [AdminController::class, 'editPizza'])->name('pizzas.edit');
    Route::put('/pizzas/{pizza}', [AdminController::class, 'updatePizza'])->name('pizzas.update');
    Route::delete('/pizzas/{pizza}', [AdminController::class, 'destroyPizza'])->name('pizzas.destroy');

    // 📦 Orders: CRUD
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}/edit', [AdminController::class, 'editOrder'])->name('orders.edit');
    Route::put('/orders/{order}', [AdminController::class, 'updateOrder'])->name('orders.update');
    Route::delete('/orders/{order}', [AdminController::class, 'destroyOrder'])->name('orders.destroy');

    // 🎭 Roles and Permissions
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    // 📲 Telegram
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::post('/notifications', [AdminController::class, 'saveNotifications'])->name('notifications.save');

    // 🛡️ Role and Permission Initialization
    Route::get('/init-roles', function () {
        $roles = ['admin', 'manager', 'cook', 'courier'];
        $permissions = [
            'view orders', 'edit orders',
            'view pizzas', 'edit pizzas', 'create pizzas', 'delete pizzas',
            'view analytics', 'edit settings', 'manage banners'
        ];

        foreach ($permissions as $perm) {
            Permission::findOrCreate($perm);
        }

        foreach ($roles as $roleName) {
            $role = Role::findOrCreate($roleName);
            if ($roleName === 'admin') {
                $role->givePermissionTo(Permission::all());
            } elseif ($roleName === 'manager') {
                $role->givePermissionTo([
                    'view orders', 'edit orders',
                    'view pizzas', 'edit pizzas',
                    'view analytics'
                ]);
            } elseif ($roleName === 'cook') {
                $role->givePermissionTo([
                    'view orders', 'edit orders',
                    'view pizzas', 'edit pizzas'
                ]);
            } elseif ($roleName === 'courier') {
                $role->givePermissionTo(['view orders']);
            }
        }

        return '✅ Rollar va ruxsatlar muvaffaqiyatli yaratildi.';
    })->name('roles.init');
});
