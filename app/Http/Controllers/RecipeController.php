<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

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
            'name' => 'required|string|min:10|max:50',
            'description' => 'required|string|min:50|max:500',
            'prep_time' => 'required|integer|max_digits:3',
            'instructions' => 'required|string|min:50',
            'image' => 'required|image',

            'ingredients' => 'array',
            'ingredients.*' => 'filled',
            'new_ingredients' => 'array',
            'new_ingredients.*' => 'filled',
            'amounts' => 'array',
            'amounts.*' => 'filled|string',
            'new_amounts' => 'array',
            'new_amounts*' => 'filled',
        ]);

        $pivotData = [];

        if ($request->has('ingredients')) {
            foreach ($request->ingredients as $ingredientId) {
                $amount = $request->amounts[$ingredientId];
                $pivotData[$ingredientId] = ['amount' => $amount];
            }
        }
        if ($request->has('new_ingredients')) {
            foreach ($request->new_ingredients as $index => $newIngredientName) {
                $newIngredientId = Ingredient::insertGetId(
                    ['name' => $newIngredientName]
                );
                $amount = $request->new_amounts[$index];
                $pivotData[$newIngredientId] = ['amount' => $amount];
            }
        }

        $recipe = new Recipe();
        $this->upload($request, $recipe);
        $recipe->ingredients()->sync($pivotData);

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
        Gate::authorize('specificUser', $recipe);

        $ingredients = Ingredient::all();
        $recipe->instructions = Collection::fromJson($recipe->instructions)->implode("\r\n");
        return view('recipes.edit', compact('recipe', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        Storage::disk('public')->delete($recipe->image_path);
        $this->upload($request, $recipe);

        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        Storage::disk('public')->delete($recipe->image_path);
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
