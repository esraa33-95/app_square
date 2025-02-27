<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Response;
use App\Http\Traits\Common;
use App\Http\Requests\Api\Front\Project\ProductRequest;
use App\Models\Product;
use App\Transformers\ProductTransform;

use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Resource\Collection;
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
        $products = Product::get();

        if(!$products)
        {
            return $this->responseApi(__('invalid'), 404);
        }
        $Products = fractal()
        ->collection($products)
        ->transformWith(new ProductTransform())
        ->toArray();

    return $this->responseApi(__('products show successfully'), $Products);
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

   
    $product = Product::create($data);

    
    if ($request->hasFile('image')) {
        $product->addMedia($request->file('image'))
                ->toMediaCollection('image'); 
    }

    return $this->responseApi(__('Product stored successfully'), new ProductTransform($product));
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
