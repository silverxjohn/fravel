<?php

namespace Plata\Fravel;

use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

class FractalResourceFactory
{
    /**
     * Create a new resource instance.
     *
     * @param mixed                             $data
     * @param callable|TransformerAbstract|null $transformer
     * @param string                            $resourceKey
     * @return Item
     */
    public function item($data, $transformer, $resourceKey)
    {
        return new Item($data, $transformer, $resourceKey);
    }

    /**
     * Create a new resource instance.
     *
     * @param mixed                             $data
     * @param callable|TransformerAbstract|null $transformer
     * @param string                            $resourceKey
     * @return Collection
     */
    public function collection($data, $transformer, $resourceKey)
    {
        return new Collection($data, $transformer, $resourceKey);
    }
}