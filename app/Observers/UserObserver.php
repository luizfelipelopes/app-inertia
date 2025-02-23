<?php

namespace App\Observers;

use App\Jobs\SendEmail;
use App\Models\User;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class UserObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        logger(__('User created!') . ' - ' . $user->name);
        SendEmail::dispatch($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        logger(__('User Updated!') . ' - ' . $user->name);
        SendEmail::dispatch($user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        logger(__('User deleted!') . ' - ' . $user->name);
    }
}
