<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Response;
use App\Http\Requests\Api\Front\Project\AreaRequest;
use App\Models\Area;

class AreaController extends Controller
{
    use Response;
    
    public function store(AreaRequest $request)
    {
        $data = $request->validated();

        $area = Area::create($data);

        return $this->responseApi(__('zone create successfully'), $area);
    }



}
