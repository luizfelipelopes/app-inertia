<?php

use App\Models\User;

use Inertia\Testing\AssertableInertia;
use function Pest\Laravel\delete;

beforeEach(function () {
    login();
});

it('should be able to delete a user', function () {

    $user = User::factory()->create();

    $response = delete(route('users.destroy', $user));
    $response->assertOk();
    $response->assertSessionHasNoErrors();
    $response->assertInertia(fn (AssertableInertia $page) =>
        $page->component('Users')
        ->has('users')
        ->has('flash')
        ->has('flash.success')
        ->where('flash.success', 'User Deleted!')
    );

});