<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    private ?int $age = null;

    /**
     * IndexController constructor.
     * @param int|null $age
     */
    public function __construct()
    {
        $this->age = 39;
    }

    public function index()
    {
        return view('index', ['age' => $this->age]);
    }
}
