<?php

use App\Models\{Question, User};

use function Pest\Laravel\actingAs;

it('should be able to publish a question', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    $this->put(route('questions.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question)->is_draft->toBe(false);
});
