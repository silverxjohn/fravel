<?php

namespace Plata\Fravel;

use League\Fractal\Manager;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;
use League\Fractal\Resource\ResourceAbstract;

class Response extends ResponseFactory
{
    /**
     * Fractal manager instance.
     *
     * @var Manager
     */
    protected $fractalManager;

    /**
     * Create a new response factory instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $view
     * @param  \Illuminate\Routing\Redirector  $redirector
     * @param Manager $fractalManager
     * @return void
     */
    public function __construct(\Illuminate\Contracts\View\Factory $view, \Illuminate\Routing\Redirector $redirector, Manager $fractalManager)
    {
        parent::__construct($view, $redirector);

        $this->fractalManager = $fractalManager;
    }

    /**
     * Return a new JSON response from the application.
     *
     * @param  ResourceAbstract  $data
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function fractal(ResourceAbstract $data, $status = 200, array $headers = [], $options = 0)
    {
        return new JsonResponse($this->fractalManager->createData($data)->toArray(), $status, $headers, $options);
    }
}