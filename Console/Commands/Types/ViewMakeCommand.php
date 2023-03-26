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
                            {--dest_dir= : copy to src/Generated/resources/views/{dest_dir} }
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
            throw new \Exception($this->className . ' not found');
        }
        $this->replaceData ['{{ namespace_view }}'] = $namespace;




        $dest_dir = $this->option('dest_dir');

        if ( $dest_dir != "" ) {
            $this->classFilePath = self::RESOURCE_DIR .  $dest_dir . "/";
        } else {
            $dest_dir = strtolower($this->className);
            $this->classFilePath = self::RESOURCE_DIR .   strtolower($this->className) . "/";
        }

        parent::handle();

        if ( $this->option('move_views_to_resources')) {
             $this->copy(
                 self::MAIN_PATH . $this->classFilePath,
                 resource_path("views/" . $dest_dir)
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
