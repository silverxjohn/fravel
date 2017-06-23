# Fravel
A Fractal wrapper for Laravel


Fractal is designed in such a way that it could be used by any frameworks or no framework at all. But wouldn't it be cool if we can use it like it's build right on top of Laravel?

## Installation

### Composer
```shell
composer require plata/fravel
```

Then in your `config/app.php`'s provider array:

```php
'providers' => [
  // ...
  'Plata\Fravel\FravelServiceProvider::class',
  // ...
]
```

and within the same file,

```php
'aliases' => [
  // ...
  ''Fractal' => \Plata\Fravel\Facade\Fractal::class',
  // ...
]
```


## Usage
For a collection of resource, 

```php
$resource = Fractal::collection(User::all(), $transformer);

return Response::fractal($resource);
```
For a single resource,

```php
$resource = Fractal::item(User::find(1), $transformer);

return Response::fractal($resource);
```

## Generators
Everyone knows that developers doesn't like repetitive tasks. That's why generators are really helpful for creating a base template for you!

### Transformers

Existing Model and Migration

```shell
php artisan make:transformer UserTransformer
```

For non existing model/migration, just append `-t` flag

```shell
php artisan make:model User -m -t
```

## Configurations

Fravel ships with a configuration file where you can change any Fractal specific behaviour. Just run:
```shell
php artisan vendor:publish
```

## Support

Need more control? Check this thorough documentation of Fravel.
