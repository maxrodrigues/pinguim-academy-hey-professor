<?php

namespace App\Http\Controllers\Question;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class UnLikeController
{
    public function __invoke(Question $question): RedirectResponse
    {
        user()->unlike($question);

        return back();
    }
}
