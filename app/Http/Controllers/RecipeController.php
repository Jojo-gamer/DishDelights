<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    // function for store & update
    private function recipeData($request): array
    {
        $data = $request->validated();
        $data['instructions'] = str($data['instructions'])
            ->split('/\r\n|\r|\n/')
            ->toJson();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';
        $data['is_active'] = true;

        return $data;
    }

    private function getPivotDataIngredients($request)
    {
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
        return $pivotData;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = $request->input('q');
        $filter = $request->input('f');

        $recipes = Recipe::where([
            ['status', 'approved'],
            ['is_active', true],
        ])
            ->when($query, function (Builder $builder, string $query) {
                $builder->whereAny([
                    'name',
                    'description',
                ], 'like', "%{$query}%");
            })
            ->when($filter, function (Builder $builder, string $filter) {
                $builder->whereHas('categories', function ($f) use ($filter) {
                    $f->where('id', $filter);
                });
            })
            ->get();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipes.create', compact('ingredients', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        $data = $this->recipeData($request);
//        AI IMAGE IF NO UPLOAD???
//        use Laravel\Ai\Image;
//        $image = Image::of('A donut sitting on the kitchen counter')->generate();
//        $rawContent = (string) $image;
        $data['image_path'] = $request->file('image')->storePublicly('recipes', 'public');
        $recipe = Recipe::create($data);

        $pivotData = $this->getPivotDataIngredients($request);
        $recipe->ingredients()->attach($pivotData);
        $categoryIds = $request->categories;
        $recipe->categories()->attach($categoryIds);

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        Gate::authorize('show', $recipe);

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
        $categories = Category::all();

        $recipe->instructions = Collection::fromJson($recipe->instructions)->implode("\r\n");
        return view('recipes.edit', compact('recipe', 'ingredients', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        Gate::authorize('specificUser', $recipe);

        $data = $this->recipeData($request);
        if ($request->hasFile('image')) {
            $oldImagePath = $recipe->image_path;
            $data['image_path'] = $request->file('image')->storePublicly('recipes', 'public');

            $recipe->update($data);
            Storage::disk('public')->delete($oldImagePath);
        } else {
            $recipe->update($data);
        }
        $pivotDataIngredients = $this->getPivotDataIngredients($request);
        $recipe->ingredients()->sync($pivotDataIngredients);
        $categoryIds = $request->categories;
        $recipe->categories()->sync($categoryIds);

        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        Gate::authorize('specificUser', $recipe);

        Storage::disk('public')->delete($recipe->image_path);
        $recipe->delete();
        return to_route('dashboard');
    }

    public function updateActiveState(Request $request, Recipe $recipe)
    {
        Gate::authorize('specificUser', $recipe);

        $recipe->update([
            'is_active' => $request->boolean('is_active'),
        ]);

        return to_route('dashboard');
    }
}
