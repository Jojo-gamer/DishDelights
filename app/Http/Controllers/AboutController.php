<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $company = 'Hogeschool Rotterdam';
        return view('about-us', compact('company'));
    }
}
