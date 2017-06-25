<?php

namespace Plata\Fravel;

use Illuminate\Filesystem\Filesystem;

class TransformerCreator
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Stub content.
     *
     * @var string
     */
    protected $stub;

    /**
     * Create a new transformer creator instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function create($name, $path)
    {
        // Get the class template.
        $stub = $this->files->get(__DIR__.'/stubs/transformer.stub');

        // Make sure the path exists.
        if (!$this->files->exists($path))
            $this->files->makeDirectory($path);

        // Write the generated template.
        $this->files->put(
            $path.'/'.$name.'Transformer.php',
            $this->populateStub($stub, $name)
        );
    }

    protected function populateStub($stub, $name)
    {
        $this->stub = $stub;

        $defaultNamespace = config('app.name') == 'Laravel'
            ? 'App'
            : config('app.name');

        return $this->setClassName($name)
                ->setTransformerNamespace($defaultNamespace)
                ->setModelNamespace($name)
                ->setParameterType($name)
                ->setParameterName($name)
                ->stub;
    }

    private function setClassName($name)
    {
        $this->stub = str_replace(
            'StubTransformer',
            $name.'Transformer',
            $this->stub
        );

        return $this;
    }

    private function setTransformerNamespace($namespace)
    {
        $this->stub = str_replace(
            'Namespace',
            $namespace.'\\Transformers',
            $this->stub
        );

        return $this;
    }

    private function setModelNamespace($name)
    {
        $this->stub = str_replace(
            'use Model',
            'use '.config('fravel.model_namespace').'\\'.$name,
            $this->stub
        );

        return $this;
    }

    private function setParameterType($name)
    {
        $this->stub = str_replace(
            'ModelInstance',
            $name,
            $this->stub
        );

        return $this;
    }

    private function setParameterName($name)
    {
        $this->stub = str_replace(
            '$model',
            '$'.strtolower($name),
            $this->stub
        );

        return $this;
    }
}