<?php

use App\Jobs\ProcessPodcast;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Inertia\Testing\AssertableInertia;

beforeEach(function() {
    login();
});


it('should send all notifications', function () {

    User::factory()->count(10)->create();

    Queue::fake();

    $response = $this->get(route('users.allNotifications'));
    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page) =>
        $page->component('Users')
        ->has('users')
        ->has('flash')
        ->where('flash.success', 'Notifications Sent!'));

    Queue::assertPushed(ProcessPodcast::class, 11);    
});


it('should send user notification', function () {

    $user = User::factory()->create();

    Queue::fake();

    $response = $this->get(route('users.notification', $user->id));
    $response->assertOk();
    $response->assertInertia(fn (AssertableInertia $page) =>
    $page->component('Users')
    ->has('users')
    ->has('flash')
    ->where('flash.success', 'Notification Sent!'));

    Queue::assertPushed(ProcessPodcast::class, 1);
});
