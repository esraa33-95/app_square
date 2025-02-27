<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Front\Project\StoreZoneRequest;
use App\Http\Traits\Response;
use App\Models\Zone;
use App\Transformers\ZoneTransform;

class ZoneController extends Controller
{
    use Response;

    public function store(StoreZoneRequest $request)
    {
        $data = $request->validated();

        $zone = Zone::create($data);

        return $this->responseApi(__('zone create successfully'), $zone);
    }

    public function index()
{
    $zones = Zone::all(); 

    if ($zones->isEmpty()) 
    { 
        return $this->responseApi(__('No zones found'), 404);
    }

    $transformedZones = fractal()
        ->collection($zones)
        ->transformWith(new ZoneTransform())
        ->toArray();

        return $this->responseApi(__('Zones retrieved successfully'), $transformedZones);

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
