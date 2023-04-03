
# package:

a terme il faudra installer :

joussin/laravel-scaffolder


    "repositories": [

        {
            "type": "vcs",
            "url": "https://github.com/joussin/laravel-scaffolder.git"
        }
    ],


"joussin/laravel-scaffolder": "0.0.5"

# .env

# --------------------------------------------
API_HOST=http://0.0.0.0:4141/api/

PACKAGE_CONFIG_KEY=laravel-scaffolder
PACKAGE_DIST_DIR_NAME=Generated
PACKAGE_DIR_NAME=laravel-scaffolder/src

## Configuration

Secrets DB conf.  

```php
// .env
DB_CONNECTION=mysql
DB_DATABASE=laravel_scaffolder
DB_HOST=192.168.0.21
DB_PORT=3094
DB_USERNAME=root
DB_PASSWORD=wg2bAQhd36aJ
```


# Models

User
Location
City
Address

Product
Cart
Command
Delivery
Payment
PaymentNotification


# scaffold

Publish config
```bash
php artisan vendor:publish --provider="SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider"
```

Generate files from config:
```bash
php artisan make:generator-conf --fresh
php artisan maker:migrate --fresh --seed
```

Publish files :  views - swagger - routes
```bash
php artisan vendor:publish --provider="SJoussin\LaravelScaffolder\ScaffolderServiceProvider"
```

```bash
php artisan serve --port=4141
```
```bash
php artisan route:list
```


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

