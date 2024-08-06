<?php

use App\Models\Question;

it('should list all questions', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);
    $questions = Question::factory(5)->create();

    $response = $this->get(route('dashboard'));

    /**
     * @var Question $q
     */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
