<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\NewsShowRequest;
use App\Models\Category;
use App\Models\News;
use function React\Promise\all;

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

    public function show(News $news /*, NewsShowRequest $request*/)
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
//        return 'ddfgdsfgds';
//        return [1,2,3];
//        return response()->json(['key' => 'value']);
//        return response()->file('');
        /*return response()
            ->view('news.show', compact('news'))
            ->header('x-app-type', 'news-page');*/
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

        /*dump($request->all()); // содержит токен!
        dump($request->validated());
        dd(1);*/

        /*$token = env('TELEGRAM_BOT_TOKEN'); // если сделать php artisan config:cache то env не будет работать (возвращает NULL, если конфиг закеширован)
        $token2 = config('telegram.bot.token'); // config:cache выполняется всегда на любом сервере, который находится в продакшене
        // вывод: всегда добавлять константы в .env, а потом дублировать их в конфиге, чтобы конфиг закешировался bootstrap/cache/config.php*/

        News::create($request->validated()); // из соображений безопасности validated() лучше, чем all()

        return redirect()->route('news.index')->with('success', 'Новость успешно добавлена!'); // with содержит flash-сообщение, которое будет лежать до момента следующего респонса
    }
}
