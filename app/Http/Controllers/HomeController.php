<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;

class HomeController extends Controller
{
    public function index()
    {
    }

    public function help()
    {
        return view('help');
    }
}
