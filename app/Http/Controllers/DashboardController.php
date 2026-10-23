<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $recipes = Auth::user()->recipes;
        return view('dashboard', compact('recipes'));
    }
}
