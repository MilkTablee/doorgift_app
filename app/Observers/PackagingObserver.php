<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Packaging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PackagingObserver
{
    /**
     * Handle the Packaging "created" event.
     */
    public function created(Packaging $packaging): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Packaging created',
                'model_type' => Packaging::class,
                'model_id' => $packaging->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Packaging "updated" event.
     */
    public function updated(Packaging $packaging): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Packaging updated',
                'model_type' => Packaging::class,
                'model_id' => $packaging->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Packaging "deleted" event.
     */
    public function deleted(Packaging $packaging): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Packaging deleted',
                'model_type' => Packaging::class,
                'model_id' => $packaging->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Packaging "restored" event.
     */
    public function restored(Packaging $packaging): void
    {
        //
    }

    /**
     * Handle the Packaging "force deleted" event.
     */
    public function forceDeleted(Packaging $packaging): void
    {
        //
    }
}
