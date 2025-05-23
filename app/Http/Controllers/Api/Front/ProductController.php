<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Response;
use App\Http\Traits\Common;
use App\Http\Requests\Api\Front\Project\ProductRequest;
use App\Services\Front\ProductService;



class ProductController extends Controller
{
    use Response;
    use Common;
    /**
     * Display a listing of the resource.
     */

     public function __construct(private ProductService $productService) {
    }
    public function index()
    {
        $data = $this->productService->index();
        return $this->responseApi(__('products show successfully'), $data);
    }
        
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
     public function store(ProductRequest $request)
     {
         $data = $this->productService->store($request);
         return $data;
     }
 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
