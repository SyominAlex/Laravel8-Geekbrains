<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $news = $category->news()->get();
        // $news = News::where('category_id', $category->id)->get();
        return view('categories.show', compact('category', 'news'));
    }
}
