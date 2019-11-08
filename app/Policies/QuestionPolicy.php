<?php

namespace App\Policies;

use App\Question;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the question.
     */
    public function view(User $user, Question $question)
    {
        return $question->user_id = $user->id;
    }
}
