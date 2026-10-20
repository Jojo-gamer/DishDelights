<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RecipeController extends Controller
{
    // function for store & update
    private function upload($request, $recipe)
    {
        $recipe->name = $request->input('name');
        $recipe->description = $request->input('description');
        $recipe->prep_time = $request->input('prep_time');
        $instructions = $request->input('instructions');
        $recipe->instructions = str($instructions)->split('/\r\n|\r|\n/')->toJson();
        if ($request->hasFile('image')) {
            //DELETE VORIGE IMAGE???
            $recipe->image_path = $request->file('image')->storePublicly('recipes', 'public');
        }
        $recipe->status = "pending";
        $recipe->is_active = true;
        $recipe->user_id = auth()->id();
        $recipe->save();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::where([
            ['status', 'approved'],
            ['is_active', true],
        ])->get();
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('recipes.create', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        AI IMAGE IF NO UPLOAD???
//        use Laravel\Ai\Image;
//        $image = Image::of('A donut sitting on the kitchen counter')->generate();
//        $rawContent = (string) $image;

        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'prep_time' => 'required|integer|max_digits:3',
            'instructions' => 'required|string',
            'image' => 'required|image',
        ]);
        $recipe = new Recipe();
        $this->upload($request, $recipe);

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->instructions = Collection::fromJson($recipe->instructions);
        return view('recipes.recipe', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $recipe->instructions = Collection::fromJson($recipe->instructions)->implode("\r\n");
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'prep_time' => 'required|integer|max_digits:3',
            'instructions' => 'required|string',
            'image' => 'image',
        ]);
        $this->upload($request, $recipe);

        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return to_route('dashboard');
    }

    public function updateActiveState(Request $request, Recipe $recipe)
    {
        //auth

        $recipe->update([
            'is_active' => $request->boolean('is_active'),
        ]);

        return to_route('dashboard');
    }
}
