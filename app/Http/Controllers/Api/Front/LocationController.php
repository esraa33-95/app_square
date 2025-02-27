<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Response;
use App\Http\Requests\Api\Front\Project\LocationRequest;
use App\Models\Location;

class LocationController extends Controller
{
    use Response;

    public function store(LocationRequest $request)
    {
        $data = $request->validated();

        $location = Location::create($data);

        return $this->responseApi(__('location create successfully'), $location);
    }
}
