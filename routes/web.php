<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// phpinfo();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/name/{name}', function (string $name): string {
    return "Hello, {$name}";
});

Route::get('/about', function () {
    return "Страница с информацией о проекте";
});

Route::get('/news', function () {
    return "Страница для вывода нескольких новостей";
});

Route::get('/news/{id}', function (string $id): string {
    return "Новость №{$id}";
});

