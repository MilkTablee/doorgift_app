<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'ip_address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    protected function tableName(): Attribute
    {
        return Attribute::make(
            get: function () {
                $modelClass = class_basename($this->model_type);
                $prefixMap = [
                    'Packaging' => 'PAC',
                    'Product' => 'PRO',
                    'Customer' => 'CUS',
                    'Order' => 'ORD',
                    'User' => 'USR',
                ];

                return $prefixMap[$modelClass] ?? Str::snake(Str::plural($modelClass));
            },
        );
    }

    protected function displayId(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->table_name . '-' . $this->model_id,
        );
    }
}
