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

php artisan make:generator Address --model --controller --controller-api  --validation-rules --factory --migration --seeder --swagger --resource --views --route --route-resource



# ------------------------------------ TODO ------------------------------------


INFO  Request [app/Http/Requests/StoreAddressRequest.php] created successfully.

INFO  Request [app/Http/Requests/UpdateAddressRequest.php] created successfully.

INFO  Policy [app/Policies/AddressPolicy.php] created successfully.



### Front:
 
model   --bo

 
# ------------------------------------ TEST ------------------------------------


```bash
php artisan make:generator Address --model --controller --controller-api  --validation-rules --factory --migration --seeder --swagger --resource --views --route --route-resource
```

````bash
php artisan  maker:views Location layout --move_views_to_resources
php artisan  maker:views Location header --move_views_to_resources
php artisan  maker:views Location footer --move_views_to_resources
php artisan  maker:views Location index --move_views_to_resources
````

```bash
php artisan  maker:controller Location    
php artisan  maker:controller Location --controller_api   
```


```bash
php artisan make:generator Address  --controller 
```



```bash
php artisan route:list
```






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

