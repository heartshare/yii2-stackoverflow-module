#Yii2 stackoverflow module

## Installation

Add to composer.json
````
 "require": {
    "shamanzpua/yii2-stackoverflow-module": "*"
 }
````
#### Configuration:

```php
<?php
'modules' => [
    'stackoverflow' => [
        'class' => 'common\modules\Stackoverflow',
        'apiKey' => 'YOUR_API_KEY' //set your api key
    ],
],
```

#### Migrations:
```bash
./yii migrate/up --migrationPath=@vendor/shamanzpua/yii2-stackoverflow-module/module/migrations

```
