<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;


class ValidationRulesMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:validation-rules {model}
    {--conf : validation-rules from conf data}';

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

            $config = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'][$this->className];

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
