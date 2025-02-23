<?php

use App\Jobs\SendEmail;
use App\Mail\OrderShipped;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

use Inertia\Testing\AssertableInertia;
use function Pest\Laravel\get;

beforeEach(function() {
    login();
});

it('should send all emails', function () {

    User::factory()->count(10)->create();

    Queue::fake();

    $response = get(route('users.allEmails'));
    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page) => 
        $page->component('Users')
        ->has('users')
        ->has('flash')
        ->where('flash.success', 'Emails Sent!')
    );    
   
    Queue::assertPushed(SendEmail::class, 11);

});

it('should send user email', function () {

    $user = User::factory()->create();

    Queue::fake();

    $response = get(route('users.email', $user));
    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page) =>
        $page->component('Users')
        ->has('users')
        ->has('flash')
        ->where('flash.success', __('Email Sent!'))
    );

    Queue::assertPushed(SendEmail::class, 1);



});