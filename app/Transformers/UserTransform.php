<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

class UserTransform extends TransformerAbstract
{
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id' => (int) $user->id,
            'email' => $user->email,
        ];
    }
}
