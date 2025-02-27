<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Product;

class ProductTransform extends TransformerAbstract
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
    public function transform(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->getFirstMediaUrl('image') ?: asset('storage/default.png'),
        ];
    }
}
