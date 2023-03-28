<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ViewMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:views {model} {template} {namespace}

                            {--move_views_to_resources : copy to laravel resources/views/{dest_dir}}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'views generator command';

    protected const RESOURCE_DIR = "resources/views/";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->className = Str::studly($this->argument('model'));
        $template = $this->argument('template');
        $namespace = $this->argument('namespace');

        $this->generatedFileName = $template;
        $this->stubFilename = "html/".$template.".blade.php.stub";

        if(
            !File::isFile(base_path( self::STUB_PATH . $this->stubFilename))
        )
        {
            throw new \Exception($this->stubFilename . ' not found');
        }

        $this->replaceData ['{{ namespace_view }}'] = $namespace . "/";


        $this->classFilePath = self::RESOURCE_DIR .  $namespace . "/". strtolower($this->className) . "/";


        parent::handle();

        if ( $this->option('move_views_to_resources')) {

             $this->copy(
                 self::MAIN_PATH . $this->classFilePath,
                 resource_path("views/" . $namespace . "/". strtolower($this->className) . "/")
             );
        }

        return Command::SUCCESS;
    }




    protected $generatedFileName = 'layout';

    protected $fileExtension = ".blade.php";

    protected $className;

    protected $classNameSuffix = "";

    protected $stubFilename = "html/layout.blade.php.stub";

    protected $classNamespace = "";

    protected $classFilePath = self::RESOURCE_DIR;





}
