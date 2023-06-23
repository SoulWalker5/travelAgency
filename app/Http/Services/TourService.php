<?php

namespace App\Http\Services;

use App\Models\Travel;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TourService
{
    public function getFilteredQuery(Travel $travel, array $filters = []): Builder
    {
        $query = $travel->tours();

        if (isset($filters['sorting']) || isset($filters['sortingField'])) {
            $query->orderBy($filters['sortingField'] ?? 'startingDate', $filters['sorting'] ?? 'asc');
        }

        if (isset($filters['priceFrom'])) {
            $query->where('price', '>=', $filters['priceFrom']);
        }

        if (isset($filters['priceTo'])) {
            $query->where('price', '<=', $filters['priceTo']);
        }

        if (isset($filters['dateFrom'])) {
            $query->where('startingDate', '>=', $filters['dateFrom']);
        }

        if (isset($filters['dateTo'])) {
            $query->where('endingDate', '<=', $filters['dateTo']);
        }

        return $query;
    }
}
