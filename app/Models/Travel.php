<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    use HasFactory, HasUuids;

    protected $table= 'travels';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'numberOfDays',
        'isPublic',
        'travel_id',
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['numberOfDays'] - 1,
        );
    }

    public function isPublic(): bool
    {
        return $this->isPublic == true;
    }

    public function scopePublic(Builder $query): Builder
    {
        return $query->where('isPublic', true);
    }
}
