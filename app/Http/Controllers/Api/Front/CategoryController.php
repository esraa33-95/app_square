<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\Project\CategoryRequest;
use App\Services\Front\CategoryService;
use App\Http\Traits\Response;
use App\Http\Traits\Common;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Response;
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function __construct(private CategoryService $categoryService) {
    }
    public function index()
    {
        $data = $this->categoryService->index();
        return $this->responseApi(__('categories show successfully'), $data);
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
    public function store(CategoryRequest $request)
    {
        $data = $this->categoryService->store($request);
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
