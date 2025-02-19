<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Response;
use App\Http\Traits\Common;
use App\Http\Requests\Api\Front\Project\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    use Response;
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::get();

        if(!$product)
        {
            return $this->responseApi(__('invalid'));
        }
        return $this->responseApi(__('products show successfully'),$product);
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
        $data = $request->validated();
    
        if($request->hasFile('image'))
        {
            $filePath = $this->uploadFile($request->image,'public/images');
            $data['image'] = Storage::url($filePath);
        }

         Product::create($data);

         return $this->responseApi(__('product store successfully'),$data);
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
