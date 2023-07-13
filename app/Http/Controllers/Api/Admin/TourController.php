<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreTourRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request): TourResource
    {
        $tour = Tour::create(ArrayHelper::snakeKeysForeignKeys($request->validated()));

        return new TourResource($tour->load('travel'));
    }
}
