<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\{RedirectResponse};

class QuestionController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $questions = user()->questions;

        return view('questions.index', compact('questions'));
    }

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

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }
}
