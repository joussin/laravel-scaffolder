<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ViewMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:views {model} {template} {dist_dir} {namespace}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'views generator command';



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->className = Str::studly($this->argument('model'));
        $template = $this->argument('template');
        $dist_dir = $this->argument('dist_dir');
        $namespace = $this->argument('namespace');

        $this->generatedFileName = $template;
        $this->stubFilename = "html/".$template.".blade.php.stub";

        if(
            !File::isFile( ( \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['STUB_PATH'] . $this->stubFilename))
        )
        {
            throw new \Exception($this->stubFilename . ' not found');
        }



        $this->replaceData ['{{ namespace_view }}'] = $namespace . "::" . $dist_dir . "/";


        $this->classFilePath = self::RESOURCE_DIR .  $namespace . "/" . $dist_dir  . "/". strtolower($this->className) . "/";

        Log::info("Save view to : " . $this->classFilePath);

        parent::handle();

        return Command::SUCCESS;
    }




    protected $generatedFileName = 'layout';

    protected $fileExtension = ".blade.php";

    protected $className;

    protected $classNameSuffix = "";

    protected $stubFilename = "html/layout.blade.php.stub";

    protected $classNamespace = "";

    protected $classFilePath = self::RESOURCE_DIR;


    protected const RESOURCE_DIR = "resources/views/";


}
