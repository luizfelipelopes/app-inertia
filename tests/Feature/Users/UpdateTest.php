<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\put;

beforeEach(function() {
    login();
    
    $this->user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'joe@mail.com']);

    $this->route = route('users.update', $this->user);    
});


it('should be able to update a user', function() {
    
    $data = [
        'name' => 'Jane Doe',
        'email' => 'joe@mail.com'
    ];    

    $response = put($this->route, $data);
    $response->assertOk();
    $response->assertSessionHasNoErrors();
    $response->assertInertia(fn (AssertableInertia $page) => 
        $page->component('Users')
        ->has('flash')
        ->where('flash.success', 'User Updated!')
    );
    
});
test('name should be required', function () {

    $data = [
        'name' => null,
        'email' => 'joe@mail.com'
    ];  

    $response = put($this->route, $data);
    $response->assertSessionHasErrors('name');

});

test('name should be max 50 characters', function () {
    
    $data = [
        'name' => str_repeat('x', 51),
        'email' => 'joe@mail.com'
    ];  

    $response = put($this->route, $data);
    $response->assertSessionHasErrors('name');

});

test('email should be required', function () {
    $data = [
        'name' => 'Jane Doe',
        'email' => null
    ];   

    $response = put($this->route, $data);
    $response->assertSessionHasErrors('email');

});

test('email should be a valid email', function () {

    $data = [
        'name' => 'Jane Doe',
        'email' => 'invalid-email'
    ];  

    $response = put($this->route, $data);
    $response->assertSessionHasErrors('email');

});