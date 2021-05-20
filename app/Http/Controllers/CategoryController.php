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
        $id = 10;
        $category = Category::where('id', $id)->first(); // если нужно проверить свойства у объекта (опубликована ли новость)
        $category = Category::where('id', '=', $id)->first(); // если нужно проверить свойства у объекта (опубликована ли новость)
        $category = Category::find($id); // просто найти по id
        $category = Category::whereId($id)->first(); // если искать по конкретному id, first - первый элемент
        $category = Category::where('id', '<', $id)
            ->orWhere('id', '>', $id + 10)
            ->get();
        $category = Category::where('id', '<', 10)
            ->orWhere(function(Builder $query){
                $query->where('id', '>', 10)
                    ->where('id', '<', 40);
            })
            ->get(); // toSql() переводит в строку SQL
        // получить кол-во новостей больше 10
        $category = Category::has('news', '>', 10)->get();
        $category = Category::has('news', '>', 10)->toSql(); // видим вложенный запрос
        $category = Category::take(1)->get()->first(); // get возвращает коллекцию, выбираем 1-ю запись из БД
        $category = Category::chunk(500, function($categories){ // для пагинации
            // Collection of categories
        });
        dd($category);
        // под капотом PDO
        \DB::insert();
        \DB::update("UPDATE categories SET name = 'test' WHERE id = 2");
        \DB::delete();

            // 1. "Чистый" запрос в БД
        $query1 = \DB::select('SELECT * FROM categories WHERE id > 5');

        // 2. Использование query builder'a
        $query2 = \DB::table('categories') // возвращает объект
            ->where('id', '>', 5) // возвращает объект
            ->get(); // возвращает коллекцию

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
        $query3 = Category::where('id', '>', 5)->get();

        // dd($query1, $query2, $query3);

    }
}
