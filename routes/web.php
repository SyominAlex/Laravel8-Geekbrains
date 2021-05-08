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

use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\AboutController as AboutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;

/*
 * 1. Главная страница
 * 2. Страница категорий
 * 3. Страница новостей
 * 4. Страница конкретной новости
 * 5. Страница комментариев
 */

Route::get('/', [IndexController::class, 'index']);

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/categories/{category}', [CategoryController::class, 'index'])->name('categories.show');

// for admin
/*Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
});*/

// for user
/*Route::get('/news', [NewsController::class, 'index'])
    ->name('news');
Route::get('/news/show/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');
Route::get('/about', [AboutController::class, 'index'])
    ->name('about');*/


/*Route::get('/news/{id}', function (string $id): string {
    return "Новость №{$id}";
});

Route::get('/name/{name}', function (string $name): string {
    return "Hello, {$name}";
});

Route::get('/about', function () {
    return "Страница с информацией о проекте";
});*/
