<?php

namespace App\Http\Controllers;

use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse};

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        request()->validate([
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule()],
        ]);

        user()
            ->questions()
            ->create([
                'question' => request()->question,
                'is_draft' => true,
            ]);

        return to_route('dashboard');
    }
}
