<?php

namespace Api\Console\Commands\Migrations;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MigrationsMakeCommand extends Command
{

    protected const MIGRATIONS_PATH = "src/Generated/Database/Migrations/";
    protected const SEEDERS_PATH = "src/Generated/Database/Seeders/";
    protected const SEEDERS_NAMESPACE = "\Api\Generated\Database\Seeders\\";

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
        $this->loopOn(self::SEEDERS_PATH, function ($file) use ($command) {
            $seedClassName = str_replace(".php", "", $file->getFilename());

            $seedClass = self::SEEDERS_NAMESPACE . $seedClassName;

            $this->info("seeder file : " . $seedClass . PHP_EOL);

            Artisan::call($command, [
                "class" => $seedClass
            ]);
        });
    }

    public function loopOnMigrations(string $command, bool $fresh)
    {
        $count = 0;

        $this->loopOn(self::MIGRATIONS_PATH, function ($file) use ($command, $fresh, &$count) {
            $this->info("$count) migrate file : " . self::MIGRATIONS_PATH . $file->getFilename() . PHP_EOL);

            $commandSuffix = "";

            if ($fresh && $count == 0) {
                $commandSuffix = ":fresh";
            }

            Artisan::call($command . $commandSuffix, [
                "--path" => self::MIGRATIONS_PATH . $file->getFilename()
            ]);


            $count++;

        });

    }

}
