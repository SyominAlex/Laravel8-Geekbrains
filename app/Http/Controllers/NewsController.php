<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

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
        return view('news.index');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));//"<h2>Отобразить запись с ID={$id}</h2>";
    }
}
