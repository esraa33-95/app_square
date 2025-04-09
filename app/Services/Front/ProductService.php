<?php

namespace App\Services\Front;

use App\Http\Traits\Response;
use App\Http\Traits\Common;
use App\Http\Requests\Api\Front\Project\ProductRequest;
use App\Models\Product;
use App\Transformers\ProductTransform;



class ProductService
{

    use Response;
    use Common;
    
    
    public function index()
    {

        $products = Product::get();

        if(!$products)
        {
            return $this->responseApi(__('invalid'), 404);
        }
       return
        fractal()->collection($products)
        ->transformWith(new ProductTransform())
        ->toArray();

       
    }


    public function store(ProductRequest $request)
{
    $data = $request->validated();

   
    $product = Product::create($data);

    
    if ($request->hasFile('image')) {
        $product->addMedia($request->file('image'))
                ->toMediaCollection('image'); 
    }

    return $this->responseApi(__('Product stored successfully'), new ProductTransform($product));
}

public function update(ProductRequest $request, $id)
    {
        
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

       
        $validatedData = $request->validated();
        $product->update($validatedData);

       
        if ($request->hasFile('image')) {
            
            $product->clearMediaCollection('image');
            
           
            $product->addMedia($request->file('image'))
                    ->toMediaCollection('image');
        }

       
        return $this->responseApi(__('Product updated successfully'), new ProductTransform($product));
    }




}