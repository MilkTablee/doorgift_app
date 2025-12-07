<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Order created',
                'model_type' => Order::class,
                'model_id' => $order->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Order updated',
                'model_type' => Order::class,
                'model_id' => $order->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Order deleted',
                'model_type' => Order::class,
                'model_id' => $order->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
