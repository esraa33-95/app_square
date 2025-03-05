<?php

namespace App\Services\Front;


use App\Http\Traits\Response;
use App\Http\Requests\Api\Front\Project\LocationRequest;
use App\Models\Location;



class LocationService
{
    use Response;


    public function store(LocationRequest $request)
{
    $data = $request->validated();


    $location = Location::create($data);

    return $this->responseApi(__('Location created successfully'), $location);
}




}