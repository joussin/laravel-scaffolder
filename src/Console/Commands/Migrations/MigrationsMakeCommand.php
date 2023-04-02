<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Migrations;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MigrationsMakeCommand extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:migrate  {--fresh} {--seed}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fresh & migrate & seed';


    public function handle()
    {

        $this->info("Start migrations" . PHP_EOL);


        $fresh = false;


        if ($this->option("fresh")) {
            $this->info("fresh db before migrate" . PHP_EOL);

            $fresh = true;
        }


        $this->info("migrate db tables" . PHP_EOL);
        $this->loopOnMigrations("migrate", $fresh);


        if ($this->option("seed")) {
            $this->info("seed db" . PHP_EOL);

            $this->loopOnSeeders("db:seed");
        }


        $this->info("End migrations" . PHP_EOL);

        return Command::SUCCESS;
    }

    public function loopOn(string $path, callable $fct)
    {
        $dir = base_path($path);
        if (File::isDirectory($dir)) {
            $files = File::files($dir);
            foreach ($files as $file) {
                $fct($file);
            }
        }
    }

    public function loopOnSeeders(string $command)
    {
        $seeders_path = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . "Database/Seeders/";

        $seeders_namespace = "\\" . \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] . "Database\Seeders\\";


        $this->loopOn($seeders_path, function ($file) use ($command, $seeders_namespace) {
            $seedClassName = str_replace(".php", "", $file->getFilename());

            $seedClass = $seeders_namespace . $seedClassName;

            $this->info("seeder file : " . $seedClass . PHP_EOL);

            Artisan::call($command, [
                "class" => $seedClass
            ]);
        });
    }

    public function loopOnMigrations(string $command, bool $fresh)
    {
        $count = 0;

        $migrations_path = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . "Database/Migrations/";


        $this->loopOn($migrations_path, function ($file) use ($command, $fresh, &$count, $migrations_path) {
            $this->info("$count) migrate file : " . $migrations_path . $file->getFilename() . PHP_EOL);

            $commandSuffix = "";

            if ($fresh && $count == 0) {
                $commandSuffix = ":fresh";
            }

            Artisan::call($command . $commandSuffix, [
                "--path" => $migrations_path . $file->getFilename()
            ]);


            $count++;

        });

    }

}
