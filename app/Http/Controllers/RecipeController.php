<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        test\r\n
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'prep_time' => 'required|integer|max_digits:3',
            'instructions' => 'required|string',
            'image' => 'required|image',
        ]);
        $recipe = new Recipe();
        $recipe->name = $request->input('name');
        $recipe->description = $request->input('description');
        $recipe->prep_time = $request->input('prep_time');
        $instructions = $request->input('instructions');
        $recipe->instructions = str($instructions)->split('/\r\n|\r|\n/')->toJson();
        $image_path = $request->file('image')->storePublicly('recipes', 'public');
        $recipe->image_path = $image_path; //to store the link to the image in the DB
        $recipe->status = "pending"; //$request->input('status');
        $recipe->is_active = true;  //$request->input('is_active');
        $recipe->user_id = auth()->id();
        $recipe->save();

        return to_route('recipes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->instructions = json_decode($recipe->instructions);
        return view('recipes.recipe', compact('recipe'));
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
