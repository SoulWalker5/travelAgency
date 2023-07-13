<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTravelRequest;
use App\Http\Requests\Admin\UpdateTravelRequest;
use App\Http\Resources\Frontend\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelRequest $request): JsonResource
    {
        $travel = Travel::create($request->validated());

        return new TravelResource($travel);
    }

    /**
     * Update existing resource.
     */
    public function update(UpdateTravelRequest $request, Travel $travel): JsonResource
    {
        $travel->update($request->validated());

        return new TravelResource($travel);
    }
}
