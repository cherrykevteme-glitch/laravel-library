<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about', [
            'name' => 'Акопян Артём',
            'group' => '3повт-24б'
        ]);
    }

    public function contacts()
    {
        return view('contacts', [
            'email' => 'example@example.com'
        ]);
    }

    public function rules()
    {
        return view('rules');
    }
}