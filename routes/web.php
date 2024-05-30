<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\pages\DashboardController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\PreventBackHistoryMiddleware;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');// Mostrar forumlario de Login
Route::post('/login-user', [LoginController::class, 'login'])->name('login-user');
Route::get('/logout-user', [LoginController::class, 'logout'])->name('logout-user');
Route::get('/registro', [UserController::class, 'create'])->name('register'); // Mostrar forumlario de registro de usuario
Route::post('/store-user', [UserController::class, 'store'])->name('store-user'); // Guardar usuario en la base de datos

Route::middleware([AuthMiddleware::class, PreventBackHistoryMiddleware::class])->group(function () {
    Route::prefix('admin')->group(function() {
        // Route::get('/', function () {return view('admin.dashboard');})->name('dashboard');
        Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard'); // Mostrar Dashboard
        
        Route::get('/listado-usuarios', [UserController::class, 'index'])->name('admin.users.index'); // Listar usuarios
        Route::post('/listado-usuarios', [UserController::class, 'search'])->name('admin.users.index'); // Buscar en el listado de usuarios
        Route::get('/editar-usuario/{id}', [UserController::class, 'edit'])->name('admin.users.edit'); // Mostrar formulario para editar usuario
        Route::post('/usuarios/update/{id}', [UserController::class, 'update'])->name('admin.users.update'); // Actualizar usuario en la base de datos
        Route::delete('/usuarios/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete'); // Eliminar usuario de ka base de datos
        
        Route::get('/listado-categorias', [CategoryController::class, 'index'])->name('admin.categories.index'); // Listar categorías
        Route::get('/editar-categoria/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit'); // Mostrar formulario para editar categoría
        Route::post('/categorias/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update'); // Actualizar categoría en la base de datos
        Route::get('/crear-categoria', [CategoryController::class, 'create'])->name('admin.categories.create'); // Mostrar formulario para crear categoría
        Route::post('/categorias/store', [CategoryController::class, 'store'])->name('admin.categories.store'); // Guardar categoría en la base de datos
        Route::delete('/categorias/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete'); // Eliminar categoría
        
        Route::get('/listado-productos', [ProductController::class, 'index'])->name('admin.products.index'); // Listar productos
        Route::get('/editar-producto/{id}', [ProductController::class, 'edit'])->name('admin.products.edit'); // Mostrar formulario para editar producto
        Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update'); // Actualizar producto en la base de datos
        Route::get('/crear-producto', [ProductController::class, 'create'])->name('admin.products.create'); // Mostrar formulario para crear producto
        Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store'); // Guardar producto en la base de datos
        Route::delete('/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete'); // Eliminar producto
        
        Route::delete('/products/delete-image/{imgId}', [ProductController::class, 'deleteProductImage'])->name('admin.products.delete-image'); // Eliminar imagen de producto
    });
    
});

// Utility routes
Route::get('/session-info', [LoginController::class, 'showSessionInfo'])->name('user-session-info'); // Mostrar la información de la sesión activa
Route::get('/phpinfo', function () {phpinfo();})->name('phpinfo');