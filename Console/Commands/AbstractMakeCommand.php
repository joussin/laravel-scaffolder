<?php

namespace Api\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;


class AbstractMakeCommand  extends GeneratorCommand implements MakeCommandInterface
{


    protected const MAIN_PATH = "src/Generated/";

    protected const ROOT_NAMESPACE = 'App\\';

    protected const MAIN_NAMESPACE = 'Api\\Generated\\';

    protected const STUB_PATH = "src/stubs/";

// --------

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $replaceData = [];

    protected $className; // "Address", "Location", "User ...

    protected $classNameSuffix; //  "ValidationRules";

    protected $stubFilename;  // "validationRules.stub";


    protected $classNamespace; //

    protected $classFilePath; //  "ValidationRules/" "Http/Controllers/" ...;



    protected function getStub()
    {
        return base_path( self::STUB_PATH . $this->stubFilename);
    }

    public function getGeneratedClassPath()
    {
        if( !is_null($this->generatedFileName))
        {
            return base_path(self::MAIN_PATH . $this->classFilePath  . $this->generatedFileName . $this->fileExtension);
        }

        $this->generatedFileName = $this->className . $this->classNameSuffix;

       return base_path(self::MAIN_PATH . $this->classFilePath  . $this->generatedFileName . $this->fileExtension);
    }



    /**
     * @return array
     */
    public function getReplaceData(): array
    {
        $this->replaceData ['{{ rootNamespace }}'] = self::ROOT_NAMESPACE ;
        $this->replaceData ['{{ namespace }}'] = self::MAIN_NAMESPACE . $this->classNamespace;
        $this->replaceData ['{{ class }}'] = $this->className . $this->classNameSuffix;

        return $this->replaceData;
    }



    public function handle()
    {

        $this->makeDirectory(      base_path(self::MAIN_PATH . $this->classFilePath  ));


        $this->getFiles()->put(
            $this->getGeneratedClassPath(),
            $this->buildClass( $this->className )
        );

        return Command::SUCCESS;
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
