<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        return Ingredient::all();
    }

    public function getPivotData($request)
    {
        $pivotData = [];
        foreach ($request->ingredients as $ingredientId) {
            $amount = $request->amounts[$ingredientId];
            $pivotData[$ingredientId] = ['amount' => $amount];
        }
        if ($request->has('new_ingredients')) {

        }
        return $pivotData;
    }

    public function store($request, $pivotData) {
        foreach ($request->new_ingredients as $index => $newIngredientName) {
            $newIngredientId = Ingredient::insertGetId(
                ['name' => $newIngredientName]
            );
            $amount = $request->new_amounts[$index];
            $pivotData[$newIngredientId] = ['amount' => $amount];
        }
    }
}
