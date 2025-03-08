<?php

namespace App\Services\Front;

use App\Http\Requests\Api\Front\Project\CategoryRequest;
use App\Http\Traits\Response;
use App\Http\Traits\Common;
use App\Models\Category;
use App\Transformers\CategoryTransform;

class CategoryService
{

    use Response;
    use Common;
    
    
    public function index()
    {

        $category = Category::get();

        if(!$category)
        {
            return $this->responseApi(__('invalid'), 404);
        }

       return
        fractal()->collection($category)
        ->transformWith(new CategoryTransform())
        ->toArray();

       
    }


    public function store(CategoryRequest $request)
{
    $category = $request->validated();

    $category= Category::create($category);
 
    if ($request->hasFile('image')) {
        $category->addMedia($request->file('image'))
                ->toMediaCollection('image'); 
    }

    return $this->responseApi(__('Product stored successfully'),new CategoryTransform($category));
}

public function update(CategoryRequest $request, $id)
{
   
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }

   
    $validatedData = $request->validated();
    $category->update($validatedData);

   
    if ($request->hasFile('image')) {
        $category->clearMediaCollection('image');
        $category->addMedia($request->file('image'))->toMediaCollection('image');
    }

    return $category;
}




}