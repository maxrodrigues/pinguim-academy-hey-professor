<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse};

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        request()->validate([
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule()],
        ]);

        $question = Question::query()->create([
            'question' => request()->question,
            'is_draft' => true,
        ]);

        return to_route('dashboard');
    }
}
