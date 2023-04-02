<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class MigrationMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:migration {model}
                            {--migration_action_create : action create table}
                            {--migration_update_create : action update table}

                            {--migration_table=}
                            {--migration_action_extra=}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migration generator description';


    protected $action = "action"; // create, update

    protected $table;

    protected $extra = ""; // ac_column_name , ec_...


    /**
     * @param string $action (create, delete, alter ... )
     * @param string $table (table_name =  "user", "route" etc)
     * @param string $extra ( "ac_file_block" : "add column file_block")
     * @param int $mid
     * @return string
     */
    public function getMigrationFilename(string $action, string $table, string $extra, int $mid = 0, string $fileSuffix = "table")
    {
        $increment = "0000" . ((string)($mid));
        return date("Y_m_d") . "_" . $increment . "_" . $action . "_" . $table . "_" . $extra . $fileSuffix;
    }


  /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = Str::studly($this->argument('model'));

        $this->replaceData ['{{ table }}'] = strtolower($this->className);

        $properties = "";

        if ($this->option('migration_action_create') ) {
            $this->action =    "create";
            $this->stubFilename =    "migration.create.stub";


            $config = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'][$this->className];

            foreach ($config['attributes'] as $name => $data)
            {
                if ($name == "id") continue;
                $db_type = $data['db_type'];
                // $name
                $properties .= '$table->'.$db_type.'(\''.$name.'\');' . PHP_EOL. PHP_EOL;
            }

            $this->replaceData ['{{ properties }}'] = $properties ;


        }
        elseif ($this->option('migration_update_create') ) {
            $this->action =    "update";
            $this->stubFilename =    "laravel/migration.update.stub";
        }

        if ($this->option('migration_table') ) {
            $this->table =  $this->option('migration_table');
        }
        else{
            $this->table = strtolower($this->className);
        }


        if ($this->option('migration_action_extra')) {
            $this->extra = $this->option('migration_action_extra') . "_";
        }

        $this->generatedFileName = $this->getMigrationFilename(
            $this->action,
            $this->table,
            $this->extra
        );

        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "Migration";

    protected $stubFilename = "laravel/migration.stub";

    protected $classNamespace = "Migrations";

    protected $classFilePath = "Database/Migrations/";


}
