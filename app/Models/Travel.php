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
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Travel::class);
    }

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['numberOfNights'] - 1,
        );
    }

    public function scopePublic(Builder $query): Builder
    {
        return $query->where('isPublic', true);
    }
}
