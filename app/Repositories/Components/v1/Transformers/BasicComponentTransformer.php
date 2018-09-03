<?php

namespace Fuindy\Repositories\Components\v1\Transformers;

use Fuindy\Repositories\Components\v1\Models\Department;
use League\Fractal\TransformerAbstract;

class BasicComponentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform($component)
    {
        return [
            'id' => $component->id,
            'name' => $component->name,
        ];
    }
}
