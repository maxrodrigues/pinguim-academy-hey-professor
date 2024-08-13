<?php

use function Pest\Laravel\actingAs;

it('should be able to list all questions created by me', function () {
    $wrongUser      = \App\Models\User::factory()->create();
    $wrongQuestions = \App\Models\Question::factory()
        ->for($wrongUser, 'createdBy')
        ->count(17)
        ->create();

    $user      = \App\Models\User::factory()->create();
    $questions = \App\Models\Question::factory()
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
