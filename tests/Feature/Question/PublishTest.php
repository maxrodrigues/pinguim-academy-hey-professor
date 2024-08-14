<?php

use App\Models\{Question, User};

use function Pest\Laravel\actingAs;

it('should be able to publish a question', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();

    $this->put(route('questions.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question)->is_draft->toBe(false);
});

it('should make sure that only the person who has created the question can publish the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    actingAs($wrongUser);

    $question = Question::factory()->create([
        'is_draft' => true, 'created_by' => $rightUser->id,
    ]);

    $this->put(route('questions.publish', $question))
        ->assertForbidden();

    actingAs($rightUser);

    $this->put(route('questions.publish', $question))
        ->assertRedirect();
});
