<?php

namespace App\RequestTransformers;

use Closure;
use Illuminate\Support\Str;

/**
 * Class RequestHandler
 *
 * @package App\RequestTransformers
 */
abstract class RequestHandler
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!request()->has($this->queryName())) {
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyTransformer($builder);
    }

    /**
     * @param $builder
     * @return mixed
     */
    protected abstract function applyTransformer($builder);

    /**
     * @return string
     */
    protected function queryName(): string
    {
        return Str::snake(class_basename($this));
    }
}
