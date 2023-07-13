<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\TravelToursIndexRequest;
use App\Http\Resources\TourResource;
use App\Http\Services\TourService;
use App\Models\Travel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TravelToursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TravelToursIndexRequest $request, Travel $travel, TourService $tourService): AnonymousResourceCollection
    {
        $filters = $request->validated();

        $query = $tourService->getFilteredQuery($travel, $filters);

        return TourResource::collection($query->paginate(config('pagination.frontend.tour.index')));
    }
}
