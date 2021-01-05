<?php

namespace App\Http\Controllers;



class HomeController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'title' => 'Home page',
        ]);
    }
}
