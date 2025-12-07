<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Customer created',
                'model_type' => Customer::class,
                'model_id' => $customer->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Customer updated',
                'model_type' => Customer::class,
                'model_id' => $customer->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Customer deleted',
                'model_type' => Customer::class,
                'model_id' => $customer->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        //
    }
}
