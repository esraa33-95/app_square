<?php

namespace App\Services\Front;


use App\Http\Requests\Api\Front\Project\StoreZoneRequest;
use App\Http\Traits\Response;
use App\Models\Zone;
use App\Transformers\ZoneTransform;



class ZoneService
{

    use Response;

    public function store(StoreZoneRequest $request)
    {
        $data = $request->validated();

        return Zone::create($data);
   
    }

    public function index()
{
    $zones = Zone::all(); 

    if ($zones->isEmpty()) 
    { 
        return $this->responseApi(__('No zones found'));
    }

    return fractal()
        ->collection($zones)
        ->transformWith(new ZoneTransform())
        ->toArray();
   
}


public function showAreasByZone($zoneId)
{
    $zone = Zone::with('areas')->find($zoneId);

    if (!$zone) {
        return $this->responseApi(__('Zone not found'), 404);
    }

    return $this->responseApi(__('Areas retrieved successfully'), $zone);
}



}