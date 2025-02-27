<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Zone;

class ZoneTransform extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     
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
     * @param Zone $zone
     * @return array
     */
    public function transform(Zone $zone): array
    {
        return [
            'id' => $zone->id,
            'name' => $zone->name,
        ];
    }
}
