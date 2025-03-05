<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Response;
use App\Http\Requests\Api\Front\Project\LocationRequest;
use App\Services\Front\LocationService; // Fixed typo

class LocationController extends Controller
{
    use Response;
    
    private LocationService $locationService; 

    public function __construct(LocationService $locationService) {
        $this->locationService = $locationService;
    }

    public function store(LocationRequest $request)
    {
        $location = $this->locationService->store($request);

        return $this->responseApi(__('Location created successfully'), $location);
    }
}
