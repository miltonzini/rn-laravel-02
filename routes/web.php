<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {return view('home');})->name('home');
Route::get('/login', function () {return view('login');})->name('login');
Route::get('/register', function () {return view('register');})->name('register');


Route::prefix('admin')->group(function() {
    Route::get('/', function () {return view('admin.dashboard');})->name('dashboard');
    
    Route::get('/users/index', [UserController::class, 'index'])->name('admin.users.index'); // Listar usuarios
    Route::get('/users/edit', function () {return view('admin.users.edit');})->name('admin.users.edit');
    Route::get('/users/create', function () {return view('admin.users.create');})->name('admin.users.create');
    
    Route::get('/categories/index', [CategoryController::class, 'index'])->name('admin.categories.index'); // Listar categorías
    Route::get('/categories/edit', function () {return view('admin.categories.edit');})->name('admin.categories.edit');
    Route::get('/categories/create', function () {return view('admin.categories.create');})->name('admin.categories.create');
    
    Route::get('/products/index', [ProductController::class, 'index'])->name('admin.products.index'); // Listar productos
    Route::get('/products/edit', function () {return view('admin.products.edit');})->name('admin.products.edit');
    Route::get('/products/create', function () {return view('admin.products.create');})->name('admin.products.create');
    
    
    Route::get('/test', function () {return view('admin.test');})->name('admin.test');
});