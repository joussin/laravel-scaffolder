<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SwaggerMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:swagger
                            {--swagger_to_public : move swagger files to public dir}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'swagger generator description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = ""; //Str::studly($this->argument('model'));

        $this->replaceData ['{{ swagger_api_url }}'] = env('API_HOST'); //"http://0.0.0.0:4141/api/" ;

        $this->replaceData ['{{ swagger_api_security_oauth2_url }}'] = "http://dev.oauth.cartegriseminute.net" ;
        $this->replaceData ['{{ swagger_api_security_oauth2_scope_1_name }}'] = "route:view" ;
        $this->replaceData ['{{ swagger_api_security_oauth2_scope_1_description }}'] = "route:view scope" ;


        $scaffold = config('scaffolder');

        $resources = $scaffold['resources'];


        $pathsStr = "";
        $tagsStr = "";
        $definitionsStr = "";

        foreach ($resources as $resource => $resourceData) {


            $resource_partial = file_get_contents("src/stubs/swagger/swagger.openapi.resource.endpoints.stub");

            $resource_partial_render = str_replace("{{ swagger_api_resource_route_name }}", strtolower($resource), $resource_partial);
            $resource_partial_render = str_replace("{{ swagger_api_resource_name }}", $resource, $resource_partial_render);

            $resource_partial_render = str_replace("{{ swagger_api_resource_route_name_id }}", 1, $resource_partial_render);
            $resource_partial_render = str_replace("{{ model_name_singular_variable }}", "{id}", $resource_partial_render);

            $pathsStr .= $resource_partial_render;


            if($resources[$resource] !== end( $resources ))
            {
                $pathsStr .= ",";
            }


            $resource_partial = file_get_contents("src/stubs/swagger/swagger.openapi.resource.tags.stub");

            $resource_partial_render = str_replace("{{ swagger_api_resource_tag_name }}", ucfirst(strtolower($resource)), $resource_partial);

            $tagsStr .= $resource_partial_render ;

            if($resources[$resource] !== end( $resources ))
            {
                $tagsStr .= ",";
            }


            $resource_partial = file_get_contents("src/stubs/swagger/swagger.openapi.resource.definitions.stub");


            $resource_partial_render = str_replace("{{ swagger_api_resource_name }}", ucfirst(strtolower($resource)), $resource_partial);



            $properties = [];

            foreach ($resourceData['attributes'] as $name => $data)
            {
                $properties[$name] = ["type" => $data['type']];
            }

            $props = json_encode($properties, JSON_PRETTY_PRINT);

            $resource_partial_render = str_replace("{{ properties_res }}", $props, $resource_partial_render);
            $resource_partial_render = str_replace(
                [
                    'int',
                    'float',
                ],
                [
                    'integer',
                    'number'
                ], $resource_partial_render);


            $definitionsStr .= $resource_partial_render ;
            if($resources[$resource] !== end( $resources ))
            {
                $definitionsStr .= ",";
            }






        }

        $this->replaceData ['{{ swagger_api_resources_paths }}'] = $pathsStr;
        $this->replaceData ['{{ tags }}'] = $tagsStr;
        $this->replaceData ['{{ definitions }}'] = $definitionsStr;





        parent::handle();

        $this->getFiles()->put(
            base_path(self::MAIN_PATH . "public/api/docs/index.html"),
            file_get_contents(base_path(self::STUB_PATH . "swagger/swagger.index.html"))
        );


        if ($this->option('swagger_to_public') ) {
            $this->copy(
                self::MAIN_PATH . $this->classFilePath,
                public_path("api/docs/")
            );
        }

        return Command::SUCCESS;
    }


    protected $generatedFileName = 'openapi';

    protected $fileExtension = ".json";

    protected $className;

    protected $classNameSuffix = "";

    protected $stubFilename = "swagger/swagger.openapi.stub";

    protected $classNamespace = "";

    protected $classFilePath = "public/api/docs/";


}
