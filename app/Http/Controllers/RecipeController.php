<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = [
            ['id' => 1, 'name' =>'Recept 1'],
            ['id' => 2, 'name' =>'Recept 2'],
            ['id' => 3, 'name' =>'Recept 3'],
        ];
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //zoek in db op id
        //get data
        $recipes = [
            ['id' => 1, 'name' =>'Recept 1'],
            ['id' => 2, 'name' =>'Recept 2'],
            ['id' => 3, 'name' =>'Recept 3'],
        ];
        $recipe = $recipes[$id-1];
        return view('recipes.recipe', compact('recipe'));
//        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
