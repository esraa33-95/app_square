<?php

namespace App\Transformers;

use App\Models\Category;

use League\Fractal\TransformerAbstract;

class CategoryTransform extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'image' => $category->getFirstMediaUrl('image') ?: asset('storage/default.png'),
        ];
    }
}
