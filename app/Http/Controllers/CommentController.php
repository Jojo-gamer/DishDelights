<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Recipe $recipe)
    {
        Comment::create([
            'recipe_id' => $recipe->id,
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        return to_route('recipes.show', compact('recipe'));
    }
}
