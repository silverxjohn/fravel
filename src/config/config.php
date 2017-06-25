<?php

/**
 * This file is part of Fravel,
 * a Fractal wrapper for Laravel.
 *
 * @license MIT
 * @package Plata\Fravel
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Json Serializer
    |--------------------------------------------------------------------------
    |
    | This is the default json serializer that will be used throughout
    | the entire response. Of course you can override this if you
    | want to set the serializer to only a certain response.
    |
    */
    'serializer' => \League\Fractal\Serializer\DataArraySerializer::class,

    /*
    |--------------------------------------------------------------------------
    | Resource base link
    |--------------------------------------------------------------------------
    |
    | This will be use to generate resource links.
    |
    */
    'base_link' => '/',

    'model_namespace' => 'App'
];
