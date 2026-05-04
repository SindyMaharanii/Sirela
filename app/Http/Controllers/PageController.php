<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tentang()
    {
        return view('tentang');
    }

    public function panduan()
    {
        return view('panduan');
    }
}