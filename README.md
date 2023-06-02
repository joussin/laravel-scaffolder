# LARAVEL-SCAFFOLDER 


# 1/ Install package 

## in composer.json :

```json
{
  "repositories": [

    {
      "type": "vcs",
      "url": "https://github.com/joussin/laravel-scaffolder.git"
    }
  ]
}
```


```json
{
  "require": {
    "joussin/laravel-scaffolder": "dev-develop"
  }
}
```

# 2/ Configuration project 

## .env configuration:

Package scaffold conf : project namespace & build dir name
```.env
PACKAGE_CONFIG_KEY=laravel-scaffolder
PACKAGE_DIST_DIR_NAME=Generated
```

Laravel DB connection conf
```.env
DB_CONNECTION=mysql
DB_DATABASE=laravel_scaffolder
DB_HOST=192.168.0.21
DB_PORT=3094
DB_USERNAME=root
DB_PASSWORD=wg2bAQhd36aJ
```


# 3/ Scaffold laravel project from config file 

## Move config file to laravel dir : '/config'

```bash
php artisan vendor:publish --provider="SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider"  --force
```

## Generate files/classes/... from config: 

Types of files generated : (model, migrations, seeder, resource, controller, routes, views, swagger, validator_rules, factory ) 

{--fresh} will delete directory define by .env(PACKAGE_DIST_DIR_NAME)

```bash
php artisan scaffold:all --fresh
```

## Migrate migrations files (just generated):

{--fresh} : delete tables before migrate
{--seed} : seed tables after migrate

```bash
php artisan scaffold:migrations --fresh --seed
```

## Publish files :  views - swagger - routes - migrations:

{--force} : will override existing files

{--tag=views} : if specified, publish views only
{--tag=swagger} : if specified, publish swagger only
{--tag=routes} : if specified, publish routes only
{--tag=migrations} : if specified, publish migrations only

```bash
php artisan vendor:publish --provider="SJoussin\LaravelScaffolder\ScaffolderServiceProvider"  --force 
```



```bash
php artisan vendor:publish --provider="SJoussin\LaravelScaffolder\InstallScaffolderServiceProvider"  --force 
```

## Unpublish files / delete all (views - swagger - routes - migrations) files :

```bash
php artisan vendor:publish --provider="SJoussin\LaravelScaffolder\UninstallScaffolderServiceProvider"
```


# 4/ Test project 

## Run server to test swagger, routes, backoffice etc:

```bash
php artisan serve --port=4444
```

## List routes in console:

```bash
php artisan route:list
```













# ------------------------------------ TODO ------------------------------------
# ------------------------------------ TODO ------------------------------------
# ------------------------------------ TODO ------------------------------------
# ------------------------------------ TODO ------------------------------------
# ------------------------------------ TODO ------------------------------------
# ------------------------------------ TODO ------------------------------------




INFO  Request [app/Http/Requests/StoreAddressRequest.php] created successfully.

INFO  Request [app/Http/Requests/UpdateAddressRequest.php] created successfully.

INFO  Policy [app/Policies/AddressPolicy.php] created successfully.


views html

migrations foreign keys

resources  foreign keys

api auth

swagger auth

# ------------------------------------ PACKAGE ------------------------------------



# package crestapps/laravel-code-generator --dev:


https://crestapps.com/laravel-code-generator/docs/2.2
composer require crestapps/laravel-code-generator --dev

AppServiceProvider dans register():

if ($this->app->runningInConsole()) {
$this->app->register('CrestApps\CodeGenerator\CodeGeneratorServiceProvider');
}


php artisan vendor:publish --provider="CrestApps\CodeGenerator\CodeGeneratorServiceProvider" --tag=default




# package jiejunf/laravel-resourceful:

https://packagist.org/packages/jiejunf/laravel-resourceful



# package cloudstudio/resource-generator:

https://novapackages.com/packages/cloudstudio/resource-generator

https://krato.github.io/resource-generator-docs/
https://krato.github.io/resource-generator-docs/1.0/how-to/fields.html

