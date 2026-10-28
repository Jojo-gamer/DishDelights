<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

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
        } elseif ($user !== null && ($user->is($recipe->user) || $user->can('admin'))) {
            return true;
        }
        return false;
    }

    public function create(User $user)
    {
        if ($user->isAdmin())
            return true;
        else {
            $commentCount = count($user->comments);
            return $commentCount >= 3 ? Response::allow() : Response::deny("Je zit op $commentCount / 3 minimum geplaatste comments");
        }
    }
}
