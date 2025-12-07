<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Product created',
                'model_type' => Product::class,
                'model_id' => $product->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Product updated',
                'model_type' => Product::class,
                'model_id' => $product->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Product deleted',
                'model_type' => Product::class,
                'model_id' => $product->id,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
