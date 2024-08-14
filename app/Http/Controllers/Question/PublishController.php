<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\{RedirectResponse};

class PublishController extends Controller
{
    use AuthorizesRequests;
    public function __invoke(Question $question): RedirectResponse
    {
        $this->authorize('publish', $question);

        $question->update([
            'is_draft' => false,
        ]);

        return back();
    }
}
