# Charts

### Charts is a multi-library chart package to create interactive charts using laravel.


## Installation

To install charts use composer

### Download

```
composer require consoletvs/charts
```

### Add service provider & alias

Add the following service provider to the array in: ```config/app.php```

```php
ConsoleTVs\Charts\ChartsServiceProvider::class,
```

Add the following alias to the array in: ```config/app.php```

```php
'Charts' => ConsoleTVs\Charts\Facades\Charts::class,
```
### Publish the assets

```
php artisan vendor:publish --tag=charts_config
php artisan vendor:publish --tag=charts_assets --force
```
