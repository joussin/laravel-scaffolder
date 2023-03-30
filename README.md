# projet laravel


creer un dossier src/ et dans composer.json

    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Api\\": "src/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },


# package:

a terme il faudra installer :

joussin/laravel_scaffolder


# .env

# --------------------------------------------


GENERATED_DIR=Generated
API_HOST=http://0.0.0.0:4141/api/

ROUTES_RESOURCE=true




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
 

```bash
php artisan make:generator-conf --fresh
php artisan maker:migrate --fresh --seed
```

php artisan vendor:publish --provider="Api\Providers\PublishServiceProvider"


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

