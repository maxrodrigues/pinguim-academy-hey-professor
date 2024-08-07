<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas};

it('should be able to like a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();
    actingAs($user);

    $this->post(route('questions.like', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);
});

it('should be not able to like more than 1 time', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();
    actingAs($user);

    $this->post(route('questions.like', $question));
    $this->post(route('questions.like', $question));

    assertDatabaseCount('votes', 1);
});
