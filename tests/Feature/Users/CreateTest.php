<?php

use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\post;

beforeEach(function() {
    login();
});

it('should be able to create a user', function () {
  
    $data = [
        'name' => 'John Doe',
        'email' => 'john@mail.com',
        'password' => 'password',
    ];

    $response = post('/users', $data);
    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page)
        => $page->component('Users')
        ->has('users')
        ->has('flash')
    );
});

test('name should be required', function () {

    $data = [
        'name' => '',
        'email' => 'john@mail.com',
        'password' => 'password',
    ];

    $response = post('/users', $data);
    $response->assertSessionHasErrors('name');

});

test('name should be max 50 characters', function () {

    $data = [
        'name' => str_repeat('x', 51),
        'email' => 'john@mail.com',
        'password' => 'password',
    ];

    $response = post('/users', $data);
    $response->assertSessionHasErrors('name');

});

test('email should be required', function () {
    $data = [
        'name' => 'John Doe',
        'email' => null,
        'password' => 'password',
    ];

    $response = post('/users', $data);
    $response->assertSessionHasErrors('email');

});

test('email should be a valid email', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@',
        'password' => 'password',
    ];

    $response = post('/users', $data);
    $response->assertSessionHasErrors('email');

});

test('password should be required', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@mail.com',
        'password' => null,
    ];

    $response = post('/users', $data);
    $response->assertSessionHasErrors('password');

});

test('password should be min 8 characters', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@mail.com',
        'password' => str_repeat('x', 7),
    ];

    $response = post('/users', $data);
    $response->assertSessionHasErrors('password');

});