<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;


class ValidationRulesMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:validation-rules {model}
    {--conf : validation-rules from data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Model validation rules generator';




    public function handle()
    {

        $this->className = Str::studly($this->argument('model'));

        $rules = '';

        if ($this->option('conf')) {

            $scaffold = config('laravel-scaffolder');

            $config = $scaffold['resources'][$this->className];

            foreach ($config['attributes'] as $name => $data)
            {
                $rule = $data['rules'];
                $rules .= "'$name' => " . "'$rule'" . ',' . PHP_EOL. PHP_EOL;
            }

        }

        $this->replaceData ['{{ rules }}'] = $rules ;


        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "ValidationRules";

    protected $stubFilename = "validation-rules.stub";

    protected $classNamespace = "ValidationRules";

    protected $classFilePath = "ValidationRules/";

}
