<?php

namespace App\RequestTransformers;

/**
 * Class Filter
 *
 * @package App\RequestTransformers
 */
class Filter extends RequestHandler
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyTransformer($builder)
    {
        if (request('value')) {
            return $builder->where(request($this->queryName()), 'like', request('value') . '%');
        }

        return $builder;
    }
}
