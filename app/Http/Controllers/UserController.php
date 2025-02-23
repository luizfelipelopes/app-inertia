<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Jobs\ProcessPodcast;
use App\Jobs\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = User::query()->paginate(10);
    }

    public function index()
    {
        $users = $this->users;

        return Inertia::render('Users', compact('users'));
    }

    public function store(UserCreateRequest $request)   
    {
        $users = $this->users;

        User::create($request->validated());
        
        $flash = ['success' => __('User Created!')];

        return Inertia::render('Users', 
        compact('users', 'flash'));

    }

    public function show(User $user)
    {
        $users = $this->users;

        return Inertia::render('Users', compact('users', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $users = $this->users;

        $user->update($request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
        ]));

        $flash = ['success' => __('User Updated!')];

        return Inertia::render('Users', 
        compact('users', 'flash'));
    }

    public function destroy(User $user)
    {
        $users = $this->users;
        
        $user->delete();

        $flash = ['success' => __('User Deleted!')];

        return Inertia::render('Users', 
        compact('users', 'flash'));
    }

    public function allNotifications()
    {
        User::all()->each(function ($user) {
            ProcessPodcast::dispatch($user);
        });

        return Inertia::render('Users', [
            'users' => $this->users,
            'flash' => ['success' => __('Notifications Sent!')]
        ]);
    }

    public function sendNotification(User $user)
    {
        ProcessPodcast::dispatch($user);

        return Inertia::render('Users', [
            'users' => $this->users,
            'flash' => ['success' => __('Notification Sent!')]
        ]);
    }

    public function sendAllEmails()
    {
        User::all()->each(function ($user) {
            SendEmail::dispatch($user);
        });

        return Inertia::render('Users', [
            'users' => $this->users,
            'flash' => ['success' => __('Emails Sent!')]
        ]);
        
    }

    public function sendEmail(User $user)
    {
        SendEmail::dispatch($user);

        return Inertia::render('Users', [
            'users' => $this->users,
            'flash' => ['success' => __('Email Sent!')]
        ]);
    }
}
