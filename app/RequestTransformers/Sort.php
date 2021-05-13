<?php

namespace App\RequestTransformers;

use Illuminate\Support\Str;

/**
 * Class Sort
 *
 * @package App\RequestTransformers
 */
class Sort extends RequestHandler
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyTransformer($builder)
    {
        if (request('order') === 'asc' || request('order') === 'desc') {
            return $builder->orderBy(Str::snake(request($this->queryName())), request('order'));
        }

        return $builder;
    }
}
