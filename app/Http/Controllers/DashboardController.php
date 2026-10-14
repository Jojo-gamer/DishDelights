<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $recipes = Recipe::where('user_id', auth()->id())->get();

        return view('dashboard', compact('recipes'));
    }
}
