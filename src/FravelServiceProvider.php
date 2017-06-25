<?php

namespace Plata\Fravel;

use League\Fractal\Manager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\Factory as ViewFactoryContract;

class FravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfigurationFiles();

        $this->commands('command.make.transformer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFacade();

        $this->registerFractalManager();

        $this->registerFravelResponse();

        $this->registerTransformerGenerator();
    }

    private function registerFacade()
    {
        $this->app->singleton('Fractal', function () {
            return new FractalResourceFactory();
        });
    }

    private function registerFractalManager()
    {
        $this->app->singleton(Manager::class, function () {
            $manager = new Manager();
            $url = \URL::to(config('fravel.base_link', '/'));
            $serializer = config('fravel.serializer', \League\Fractal\Serializer\DataArraySerializer::class);

            $manager->setSerializer(new $serializer($url));

            return $manager;
        });
    }

    private function registerFravelResponse()
    {
        \Response::swap(new \Plata\Fravel\Response(
            $this->app[ViewFactoryContract::class],
            $this->app['redirect'],
            $this->app[Manager::class]
        ));
    }

    private function registerTransformerGenerator()
    {
        $this->app->singleton('transformer.creator', function ($app) {
            return new TransformerCreator($app['files']);
        });

        $this->app->singleton('command.make.transformer', function ($app) {
            // Once we have the migration creator registered, we will create the command
            // and inject the creator. The creator is responsible for the actual file
            // creation of the transformers, and may be extended by developers.
            $creator = $app['transformer.creator'];

            $composer = $app['composer'];

            return new TransformerMakeCommand($creator, $composer);
        });
    }

    private function bootConfigurationFiles()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => app()->basePath() . '/config/fravel.php',
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'Fractal',
            'transformer.creator',
            'command.make.transformer'
        ];
    }
}
