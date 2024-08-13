<?php

use App\Models\{Question, User};

use function Pest\Laravel\actingAs;

it('should be able to list all questions created by me', function () {
    $wrongUser      = User::factory()->create();
    $wrongQuestions = Question::factory()
        ->for($wrongUser, 'createdBy')
        ->count(17)
        ->create();

    $user      = User::factory()->create();
    $questions = Question::factory()
        ->for($user, 'createdBy')
        ->count(7)
        ->create();

    actingAs($user);

    $response = $this->get(route('questions.index'));

    foreach ($questions as $question) {
        $response->assertSee($question->question);
    }

    foreach ($wrongQuestions as $wrongQuestion) {
        $response->assertDontSee($wrongQuestion->question);
    }
});
