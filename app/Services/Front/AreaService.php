<?php

namespace App\Services\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Response;
use App\Http\Requests\Api\Front\Project\AreaRequest;
use App\Models\Area;



class AreaService
{
    use Response;

    public function store(AreaRequest $request)
    {
        $data = $request->validated();

       return Area::create($data);

        
    }

    



}