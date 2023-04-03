<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Console\Command;

class SwaggerMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:swagger';

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
        $this->className = "";

        $api = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['api'];

        $this->replaceData ['{{ swagger_api_url }}'] = $api['host']; //"http://0.0.0.0:4141/api/" ;

        // ---

        $oauth = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['oauth'];

        $securitySwaggerStr = file_get_contents( (\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig() ['STUB_PATH']  . "swagger/swagger.openapi.resource.security-schemes.stub"));
        $securitySwaggerStr = str_replace("{{ swagger_api_security_oauth2_url }}", $oauth['host'], $securitySwaggerStr);

        $scopesProps = "";

        foreach ($oauth['scopes'] as $scope => $scopeDesc)
        {
            $scopesProps .= '"'.$scope.'" : "'.$scopeDesc.'"' . PHP_EOL;

            if($oauth['scopes'][$scope] !== end( $oauth['scopes'] ))
            {
                $scopesProps .= ",";
            }
        }

        $securitySwaggerStr = str_replace("{{ swagger_api_security_oauth2_scopes }}", $scopesProps, $securitySwaggerStr);

        $this->replaceData ['{{ securitySchemes }}'] = $securitySwaggerStr;


        $resources = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'];


        $pathsStr = "";
        $tagsStr = "";
        $definitionsStr = "";


        foreach ($resources as $resource => $resourceData) {

            $stub_path = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['STUB_PATH'];

            $resource_partial = file_get_contents($stub_path . "swagger/swagger.openapi.resource.endpoints.stub");

            $resource_partial_render = str_replace("{{ swagger_api_resource_route_name }}", strtolower($resource), $resource_partial);
            $resource_partial_render = str_replace("{{ swagger_api_resource_name }}", $resource, $resource_partial_render);

            $resource_partial_render = str_replace("{{ swagger_api_resource_route_name_id }}", 1, $resource_partial_render);
            $resource_partial_render = str_replace("{{ model_name_singular_variable }}", "{id}", $resource_partial_render);

            $pathsStr .= $resource_partial_render;


            if($resources[$resource] !== end( $resources ))
            {
                $pathsStr .= ",";
            }


            $resource_partial = file_get_contents($stub_path . "swagger/swagger.openapi.resource.tags.stub");

            $resource_partial_render = str_replace("{{ swagger_api_resource_tag_name }}", ucfirst(strtolower($resource)), $resource_partial);

            $tagsStr .= $resource_partial_render ;

            if($resources[$resource] !== end( $resources ))
            {
                $tagsStr .= ",";
            }


            $resource_partial = file_get_contents($stub_path . "swagger/swagger.openapi.resource.definitions.stub");


            $resource_partial_render = str_replace("{{ swagger_api_resource_name }}", ucfirst(strtolower($resource)), $resource_partial);
            $resource_partial_render = str_replace("{{ swagger_api_resource_name_post_put }}", ucfirst(strtolower($resource))."PostPut", $resource_partial_render);



            $properties = [];
            $propertiesPostPut = [];

            foreach ($resourceData['attributes'] as $name => $data)
            {
                $properties[$name] = ["type" => $data['type']];
                if($name != "id")
                {
                    $propertiesPostPut[$name] = ["type" => $data['type']];
                }
            }

            $props = json_encode($properties, JSON_PRETTY_PRINT);
            $propsPostPut = json_encode($propertiesPostPut, JSON_PRETTY_PRINT);

            $resource_partial_render = str_replace("{{ properties_res }}", $props, $resource_partial_render);
            $resource_partial_render = str_replace("{{ properties_res_post_put }}", $propsPostPut, $resource_partial_render);
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
            (\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . "public/api/docs/index.html"),
            file_get_contents( (\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig() ['STUB_PATH']  . "swagger/swagger.index.html"))
        );




        $routeSwaggerStr = file_get_contents( (\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig() ['STUB_PATH']  . "swagger/routes-swagger.stub"));
        $routeSwaggerStr = str_replace("{{ package_config_key }}", \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfigKey(), $routeSwaggerStr);


        $this->getFiles()->put(
            ( \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . "routes/routes-swagger.php"),
            $routeSwaggerStr
        );



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
