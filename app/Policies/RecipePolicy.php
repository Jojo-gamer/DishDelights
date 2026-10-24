<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecipePolicy
{
    public function specificUser(User $user, Recipe $recipe): bool
    {
//      check if recipe is from logged in user
        return $user->is($recipe->user);
    }

    public function show(?User $user, Recipe $recipe): bool
    {
        if ($recipe->status === 'approved' && $recipe->is_active) {
            return true;
        } elseif ($user !== null && $user->is($recipe->user)) {
            return true;
        }
        return false;
    }
}
