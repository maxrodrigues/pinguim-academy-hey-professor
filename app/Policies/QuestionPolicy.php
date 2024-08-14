<?php

namespace App\Policies;

use App\Models\{Question, User};
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    public function publish(User $user, Question $question): bool
    {
        return $question->createdBy->is($user);
    }

    public function destroy(User $user, Question $question): Response
    {
        return $question->createdBy->is($user) ? Response::allow() : Response::denyWithStatus(403);
    }
}
