<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Response;
use App\Http\Requests\Api\Front\Project\AreaRequest;
use App\Models\Area;
use App\Services\Front\AreaService;

class AreaController extends Controller
{
    use Response;

    public function __construct(private AreaService $areaService) {
    }
    
    public function store(AreaRequest $request)
    {
        $area = $this->areaService->store($request);
        return $this->responseApi(__('area create successfully'), $area);
    }


    

}
