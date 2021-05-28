<?php

namespace App\Observers;

use App\Models\News;

class NewsObserver
{
    public function creating(News $news) // вызывается до запроса в БД (см. storage/logs/laravel.log)
    {
        if (!$news->rating) {
            $news->rating = rand(1,5); // creating дает возможность изменения данных перед вставкой в базу
        }

        \Log::info("Model is creating. ID: {$news->id}");
    }

    public function created(News $news) // вызывается после запроса в БД (см. storage/logs/laravel.log)
    {
        \Log::info("Model created. ID: {$news->id}");
    }
}
