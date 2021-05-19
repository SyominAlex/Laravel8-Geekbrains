<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): string
    {
        //return "Вас приветствует агрегатор новостей на Laravel 8";
        return view('welcome');
    }
}
