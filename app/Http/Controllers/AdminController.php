<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $recipes = Recipe::where([
            'status' => 'pending'
        ])
            ->orderBy('created_at')
            ->get();
        return view('admin', compact('recipes'));
    }

    public function approve(Recipe $recipe)
    {
        $recipe->update([
            'status' => 'approved'
        ]);
        return to_route('admin');
    }

    public function reject(Recipe $recipe)
    {
        $recipe->update([
            'status' => 'rejected'
        ]);
        return to_route('admin');
    }
}
