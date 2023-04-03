<?php

namespace SJoussin\LaravelScaffolder\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;


abstract class AbstractMakeCommand  extends GeneratorCommand
{



    // -------------TO-OVERRIDE-BY-MAKER-COMMAND-------------------

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $replaceData = [];

    protected $className; // "Address", "Location", "User ...

    protected $classNameSuffix; //  "ValidationRules";

    protected $stubFilename;  // "validationRules.stub";

    protected $classNamespace; //

    protected $classFilePath;//  "ValidationRules/" "Http/Controllers/" ...;


    // ----------------------------------------------------------------------

    public function handle()
    {

        $this->makeDirectory(  \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . $this->classFilePath    );


        $this->getFiles()->put(
            $this->getGeneratedClassPath(),
            $this->buildClass( $this->className )
        );

        return Command::SUCCESS;
    }



    protected function getStub()
    {
        return \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['STUB_PATH'] . $this->stubFilename;
    }

    public function getGeneratedClassPath()
    {
        if( !is_null($this->generatedFileName))
        {
            return (\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . $this->classFilePath  . $this->generatedFileName . $this->fileExtension);
        }

        $this->generatedFileName = $this->className . $this->classNameSuffix;

       return (\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . $this->classFilePath  . $this->generatedFileName . $this->fileExtension);
    }


    public function getReplaceData(): array
    {
        $this->replaceData ['{{ rootNamespace }}'] = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['LARAVEL_ROOT_NAMESPACE'] ;
        $this->replaceData ['{{ namespace }}'] = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] . $this->classNamespace;
        $this->replaceData ['{{ class }}'] = $this->className . $this->classNameSuffix;

        return $this->replaceData;
    }

    public function copy(string $from, string $to)
    {
        $mv = File::copyDirectory($from, $to);
    }

    protected function makeDirectory($path)
    {
        if(is_dir($path))
        {
            return $path;
        }

        File::makeDirectory($path, 0755, true);

        return $path;
    }


    protected function buildClass($name)
    {
        $stubClassContent = file_get_contents( $this->getStub() );

        return str_replace(
            array_keys($this->getReplaceData()), array_values($this->getReplaceData()), $stubClassContent
        );
    }

    public function getFiles()
    {
        return  app()->make(Filesystem::class);
    }
}
