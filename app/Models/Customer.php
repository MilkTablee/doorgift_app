<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected function displayId(): Attribute
    {
        return Attribute::make(
            get: fn () => 'CUS-' . $this->id,
        );
    }
}
