<?php

namespace App\Policies;

use App\Answer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the question.
     */
    public function view(User $user, Answer $answer)
    {
        return $answer->user_id = $user->id;
    }
}
