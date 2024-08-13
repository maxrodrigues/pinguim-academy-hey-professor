<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas};

it('should be able to create a new question bigger than 255 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = $this->post(route('questions.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

it('should have at least 10 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = $this->post(route('questions.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});

it('should check if ends with question mark ?', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = $this->post(route('questions.store'), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question? It is missing the question mark in the end.']);
    assertDatabaseCount('questions', 0);
});

it('should create as a draft all the time', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = $this->post(route('questions.store'), [
        'question' => str_repeat('*', 20) . '?',
    ]);

    assertDatabaseHas('questions', ['question' => str_repeat('*', 20) . '?', 'is_draft' => true]);
});

test('only authenticated user can create a question', function () {
    $this->post(route('questions.store'), [
        'question' => str_repeat('*', 20) . '?',
    ])->assertRedirect(route('login'));
});
