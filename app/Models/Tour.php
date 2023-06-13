<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
