<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'User created',
                'model_type' => User::class,
                'model_id' => $user->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'User updated',
                'model_type' => User::class,
                'model_id' => $user->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'User deleted',
                'model_type' => User::class,
                'model_id' => $user->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
