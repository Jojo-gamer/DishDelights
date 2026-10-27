<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function delete(User $user, Comment $comment): bool
    {
//      check if comment is from logged in user
        return $user->is($comment->user);
    }
}
