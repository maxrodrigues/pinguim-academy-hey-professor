<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

it('should be able to delete a question', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();

    $this->delete(route('questions.delete', $question))
        ->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);
});

it('should make sure that only the person who has created the question can delete the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    actingAs($wrongUser);

    $question = Question::factory()->create([
        'is_draft' => true, 'created_by' => $rightUser->id,
    ]);

    $this->delete(route('questions.delete', $question))
        ->assertForbidden();

    actingAs($rightUser);

    $this->delete(route('questions.delete', $question))
        ->assertRedirect();
});
