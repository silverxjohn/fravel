<?php

namespace Plata\Fravel;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class TransformerMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:transformer {name : The name of the transformer.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new transformer class';

    /**
     * TransformerCreator instance.
     *
     * @var TransformerCreator
     */
    private $transformerCreator;

    /**
     * Composer instance.
     *
     * @var Composer
     */
    private $composer;

    /**
     * Create a new command instance.
     *
     * @param TransformerCreator $transformerCreator
     * @param Composer $composer
     * @return void
     */
    public function __construct(TransformerCreator $transformerCreator, Composer $composer)
    {
        parent::__construct();
        $this->transformerCreator = $transformerCreator;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = trim($this->input->getArgument('name'));

        // Checks to see if the name already has a Transformer suffix.
        $name = str_contains($name, 'Transformer')
            ? str_replace('Transformer', '', $name)
            : $name;

        $this->transformerCreator->create($name, app_path('Transformers'));

        $this->line("<info>Transformer created successfully.</info>");

        $this->composer->dumpAutoloads();
    }
}
