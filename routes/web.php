<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');})->name('home');
Route::get('/login', function () {return view('login');})->name('login');
Route::get('/register', function () {return view('register');})->name('register');


Route::get('/admin', function () {return view('admin.dashboard');})->name('dashboard');

Route::get('/admin/users/index', function () {return view('admin.users.index');})->name('admin.users.index');
Route::get('/admin/users/edit', function () {return view('admin.users.edit');})->name('admin.users.edit');
Route::get('/admin/users/create', function () {return view('admin.users.create');})->name('admin.users.create');

Route::get('/admin/categories/index', function () {return view('admin.categories.index');})->name('admin.categories.index');
Route::get('/admin/categories/edit', function () {return view('admin.categories.edit');})->name('admin.categories.edit');
Route::get('/admin/categories/create', function () {return view('admin.categories.create');})->name('admin.categories.create');

Route::get('/admin/products/index', function () {return view('admin.products.index');})->name('admin.products.index');
Route::get('/admin/products/edit', function () {return view('admin.products.edit');})->name('admin.products.edit');
Route::get('/admin/products/create', function () {return view('admin.products.create');})->name('admin.products.create');


Route::get('/admin/test', function () {return view('admin.test');})->name('admin.test');