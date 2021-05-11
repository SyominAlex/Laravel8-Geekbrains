<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\NewsShowRequest;
use App\Models\Category;
use App\Models\News;
// use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        //return "<h2>Список новостей</h2>";
        //перенесли генерацию в views/news.php
        /*foreach ($this->newsList as $news) {
            echo $news . "<br>";
        }*/
        //dd($this->newsList, 'hello');
        //return view('news', ['newsList' => $this->newsList]);

        // eager loading
        // $news = News::all();
        // dd($news);
        $news = News::with('category')->get();
        return view('news.index', compact('news'));
    }

    /*public function show(News $news)
    {
        return view('news.show', compact('news'));//"<h2>Отобразить запись с ID={$id}</h2>";
    }*/

    public function show(News $news/*, NewsShowRequest $request*/)
    {
        // делать валидацию в методе контроллера плохо: спагетти-код, метод контроллера не ответственен за валидацию, он должен получать отвалидированный request
        // response должен отдаваться еще до момента вызова контроллера
        // кастомизация php artisan make:request NewsShowRequest - создан новый класс app/Http/Requests/NewsShowRequest.php
        /*$request->validate([
            'id' => ['integer', 'max:5']
        ]);

        dd($request);*/
        // dd(session());
        return view('news.show', compact('news')); //"<h2>Отобразить запись с ID={$id}</h2>";
    }

    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function store(StoreNewsRequest $request)
    {
        /*$news = new News();
        $news->category_id = $request->get('category_id');
        $news->title = $request->get('title');
        $news->description = $request->get('description');
        $news->save();*/
        News::create($request->all());

        return redirect()->route('news.index');
    }
}
