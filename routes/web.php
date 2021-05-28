<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Models\Category;
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

Route::get('/', function () {

    // вывод 3 цветных сообщений в messages Debug Bar
    Log::info('test', ['asd', 'asd']); // Можно ли передать объект? Второй аргумент должен быть массивом - его всегда выведет
    Log::info('test', [new stdClass()]); // Либо stdClass
    Log::warning('test');
    Log::error('test');
    // $news = \App\Models\News::all();

    // про коллекции:
    /*$collection = Category::all()->filter(function(Category $category){
        return $category->id < 5;
    }); // фильтрует содержимое */
    /*$collection = Category::all()->map(function(Category $category){
        return $category->id;
    }); // map создает новую коллекцию с возвращенным содержимым*/
//    $collection = Category::all()->pluck('id')->toArray(); // то же самое, но короче, чем мэпить + перевод в массив
////    $collection = Category::all()->pluck('id')->dd();
//    dd($collection);

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news/create', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show'); // этот шаблон ставим после create, чтобы не искал create как id

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

require __DIR__.'/auth.php';

