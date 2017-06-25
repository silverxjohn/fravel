<?php

namespace Plata\Fravel\Facade;

use Illuminate\Support\Facades\Facade;

class Fractal extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Fractal';
    }
}