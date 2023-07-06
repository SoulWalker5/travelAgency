<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreTravelRequest;
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
}
