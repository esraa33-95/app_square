<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\Project\StoreZoneRequest;
use App\Http\Traits\Response;
use App\Models\Zone;
use App\Services\Front\ZoneService;


class ZoneController extends Controller
{
    use Response;
    public function __construct(private ZoneService $zoneService) {
    }

    public function store(StoreZoneRequest $request)
    {
        $zone = $this->zoneService->store($request);
        
        return $this->responseApi(__('zone create successfully'), $zone);
    }


    public function index()
    {
        $data = $this->zoneService->index();
        return $this->responseApi(__('zones show successfully'), $data);
    }



public function showAreasByZone($zoneId)
{
   return $this->zoneService->showAreasByZone($zoneId);
   
}



}
