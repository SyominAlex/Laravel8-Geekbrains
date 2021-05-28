<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $news = $category->news()->get();
        // $news = News::where('category_id', $category->id)->get();
        return view('categories.show', compact('category', 'news'));
    }

    public function index()
    {
//        $id = 10;
//        $category = Category::where('id', $id)->first(); // если нужно проверить свойства у объекта (опубликована ли новость)
//        $category = Category::where('id', '=', $id)->first(); // если нужно проверить свойства у объекта (опубликована ли новость)
//        $category = Category::find($id); // просто найти по id
//        $category = Category::whereId($id)->first(); // если искать по конкретному id, first - первый элемент
//        $category = Category::where('id', '<', $id)
//            ->orWhere('id', '>', $id + 10)
//            ->get();
//        $category = Category::where('id', '<', 10)
//            ->orWhere(function(Builder $query){
//                $query->where('id', '>', 10)
//                    ->where('id', '<', 40);
//            })
//            ->get(); // toSql() переводит в строку SQL

        // получить кол-во новостей больше 10
        /*$categories = Category::has('news', '>', 10)->get();
        return view('categories.index', compact('categories'));*/

        // вывести кол-во новостей в каждой категории
//        $categories = Category::with('news')->get(); // with подгружает все релейшены, итого больше 1000 запросов
//        $categories = Category::withCount('news')
//            ->withAvg('news', 'rating')
//            //->take(5)
//            ->get(); // уже меньше, если в index.blade изменить - уже 60 моделей на фронте
        // dd($categories); // появился news_avg_rating

        // рандомно получить 5 новостей
        $categories = Category::withCount('news')
            ->withAvg('news', 'rating')
            ->inRandomOrder()
            ->take(5)
            ->get();
        return view('categories.index', compact('categories'));

//        $category = Category::has('news', '>', 10)->toSql(); // видим вложенный запрос // ->join() аналогично
//        $category = Category::take(1)->get()->first(); // get возвращает коллекцию, выбираем 1-ю запись из БД
//        $category = Category::chunk(500, function($categories){ // для пагинации
//            // Collection of categories
//        });
//        dd($category);
        // под капотом PDO
//        \DB::insert();
//        \DB::update("UPDATE categories SET name = 'test' WHERE id = 2");
//        \DB::delete();


        // 1. "Чистый" запрос в БД
//        $query1 = \DB::select('SELECT * FROM categories WHERE id > 5');

        // 2. Использование query builder'a
//        $query2 = \DB::table('categories') // возвращает объект
//            ->where('id', '>', 5) // возвращает объект
//            ->get(); // возвращает коллекцию

        /*$a = json_decode('{"asd": "test"}', true);
        $b = json_decode('{"asd": "test"}', false);
        dd($a, $b);*/
        // вывод:
        /*array:1 [▼
          "asd" => "test"
        ]
        {#448 ▼
          +"asd": "test"
        }*/

        // 3. Использование Eloquent
//        $query3 = Category::where('id', '>', 5)->get();

        // dd($query1, $query2, $query3);

    }
}
