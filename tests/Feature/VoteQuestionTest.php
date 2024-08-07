<?php

use function Pest\Laravel\assertDatabaseHas;

it('should be able to like a question', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();
    \Pest\Laravel\actingAs($user);

    $this->post(route('questions.like', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);
});
