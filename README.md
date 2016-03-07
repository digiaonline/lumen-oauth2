# Lumen OAuth2

[![Code Climate](https://codeclimate.com/github/nordsoftware/lumen-oauth2/badges/gpa.svg)](https://codeclimate.com/github/nordsoftware/lumen-oauth2)
[![Latest Stable Version](https://poser.pugx.org/nordsoftware/lumen-oauth2/version)](https://packagist.org/packages/nordsoftware/lumen-oauth2) 
[![Total Downloads](https://poser.pugx.org/nordsoftware/lumen-oauth2/downloads)](https://packagist.org/packages/nordsoftware/lumen-oauth2)
[![License](https://poser.pugx.org/nordsoftware/lumen-oauth2/license)](https://packagist.org/packages/nordsoftware/lumen-oauth2)

OAuth2 module for the [Lumen PHP framework](http://lumen.laravel.com/).

## Requirements

- PHP 5.4 or newer
- [Composer](http://getcomposer.org)

## Usage

### Installation

Run the following command to install the package through Composer:

```sh
composer require nordsoftware/lumen-oauth2
```

### Configure

Copy the configuration template in `config/oauth2.php` to your application's `config` directory and modify according to your needs. For more information see the [Configuration Files](http://lumen.laravel.com/docs/configuration#configuration-files) section in the Lumen documentation.

### Bootstrapping

Add the following lines to ```bootstrap/app.php```:

```php
$app->configure('oauth2');
```

```php
$app->register('Nord\Lumen\OAuth2\Eloquent\EloquentServiceProvider');
$app->register('Nord\Lumen\OAuth2\OAuth2ServiceProvider');
```

```php
$app->routerMiddleware([
	.....
	'Nord\Lumen\OAuth2\Middleware\OAuth2Middleware',
]);
```

## Contributing

Please read the [guidelines](.github/CONTRIBUTING.md).

## License

See [LICENSE](LICENSE).
