<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class myTest1Controller extends Controller
{
    public function index()
    {
        return view('backend.test');
    }
}
