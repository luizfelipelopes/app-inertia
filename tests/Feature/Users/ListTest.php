<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Testing\AssertableInertia;

beforeEach(function() {
    login();
    Cache::flush();
});

it('should be authorized', function () {

    Auth::logout();
    $this->getJson(route('users.index'))->assertUnauthorized();

    login();
    $this->getJson(route('users.index'))->assertSuccessful();

});


it('should be loaded', function () {
    
    User::factory()->count(10)->create();

    $response = $this->get(route('users.index'));

    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page) => 
        $page->component('Users')
        ->has('users.data', 11)
    );
});

it('should be paginated', function () {

    User::factory()->count(500)->create();

    $response = $this->get(route('users.index'));

    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page) =>
    $page->component('Users')
        ->has('users')
        ->has('users.data', 500)
        ->has('users.links')
        ->where('users.per_page', 500)
    );

    
});


