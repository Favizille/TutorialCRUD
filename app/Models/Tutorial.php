<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tutorial extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $incrementing = false;

    // Set the key type to 'string' since UUIDs are not integers
    protected $keyType = 'string';

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            // Automatically generate a UUID if not already set
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }
}
