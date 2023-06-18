<?php

namespace App\Observers;

use App\Models\Travel;
use Illuminate\Support\Str;

class TravelObserver
{
    /**
     * Handle the Travel "created" event.
     */
    public function creating(Travel $travel): void
    {
        $slug = Str::slug($travel->name);

        $existingSlug = Travel::where('slug', 'like', "$slug%")->orderByDesc('slug')->first()?->slug;

        if ($existingSlug) {
            if ($slug === $existingSlug) {
                $slug .= '-1';
            } else {
                $slug .= Str::substr($existingSlug, -2) - 1;
            }
        }

        $travel->slug = $slug;
    }
}
