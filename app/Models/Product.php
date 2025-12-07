<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'is_visible',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    protected function displayId(): Attribute
    {
        return Attribute::make(
            get: fn () => 'PRO-' . $this->id,
        );
    }
}
