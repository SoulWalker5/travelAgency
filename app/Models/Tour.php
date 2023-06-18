<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'travelId',
        'name',
        'startingDate',
        'endingDate',
        'price',
    ];

    protected $casts = [
        'startingDate' => 'datetime',
        'endingDate' => 'datetime',
    ];

    public function travels(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100,
        );
    }
}
