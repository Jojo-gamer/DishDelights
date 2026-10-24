<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecipePolicy
{
    public function specificUser(User $user, Recipe $recipe): bool
    {
//        return $user->id === $recipe->user_id;
        return $user->is($recipe->user);
    }
}
