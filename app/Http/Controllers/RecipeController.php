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
            ['id' => 1, 'name' =>'Recept 1', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 15],
            ['id' => 2, 'name' =>'Recept 2', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 12],
            ['id' => 3, 'name' =>'Recept 3', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 18],
            ['id' => 4, 'name' =>'Recept 4', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 18],
            ['id' => 5, 'name' =>'Recept 5', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 18],
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
            ['id' => 1, 'name' =>'Recept 1', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 15],
            ['id' => 2, 'name' =>'Recept 2', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 12],
            ['id' => 3, 'name' =>'Recept 3', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 18],
            ['id' => 4, 'name' =>'Recept 4', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 18],
            ['id' => 5, 'name' =>'Recept 5', 'description' => 'lorem impsum drate krilum de pesrta', 'prep-time' => 18],
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
