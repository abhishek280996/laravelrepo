<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyTestController extends Controller
{
    public function index()
    {
        return view('backend.test');
    }
}
