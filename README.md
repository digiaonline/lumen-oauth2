# Lumen OAuth2

[![Build Status](https://travis-ci.org/nordsoftware/lumen-oauth2.svg?branch=master)](https://travis-ci.org/nordsoftware/lumen-oauth2)
[![Coverage Status](https://coveralls.io/repos/github/nordsoftware/lumen-oauth2/badge.svg?branch=master)](https://coveralls.io/github/nordsoftware/lumen-oauth2?branch=master)
[![Code Climate](https://codeclimate.com/github/nordsoftware/lumen-oauth2/badges/gpa.svg)](https://codeclimate.com/github/nordsoftware/lumen-oauth2)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nordsoftware/lumen-oauth2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nordsoftware/lumen-oauth2/?branch=master)
[![StyleCI](https://styleci.io/repos/35571322/shield?style=flat)](https://styleci.io/repos/35571322)
[![Latest Stable Version](https://poser.pugx.org/nordsoftware/lumen-oauth2/version)](https://packagist.org/packages/nordsoftware/lumen-oauth2) 
[![Total Downloads](https://poser.pugx.org/nordsoftware/lumen-oauth2/downloads)](https://packagist.org/packages/nordsoftware/lumen-oauth2)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Gitter](https://img.shields.io/gitter/room/norsoftware/open-source.svg?maxAge=2592000)](https://gitter.im/nordsoftware/open-source)

OAuth2 module for the [Lumen PHP framework](http://lumen.laravel.com/).

## Requirements

- PHP 5.6 or newer
- [Composer](http://getcomposer.org)
- [Lumen](https://lumen.laravel.com/) 5.3 or newer

## Usage

### Installation

Run the following command to install the package through Composer:

```sh
composer require nordsoftware/lumen-oauth2
```

### Configure

Copy the configuration template in `config/oauth2.php` to your application's `config` directory and modify according to your needs.
For more information see the [Configuration Files](http://lumen.laravel.com/docs/configuration#configuration-files) section in the Lumen documentation.

### Bootstrapping

Add the following lines to ```bootstrap/app.php```:

```php
$app->configure('oauth2');
```

```php
$app->register('Nord\Lumen\OAuth2\Eloquent\EloquentServiceProvider');
$app->register('Nord\Lumen\OAuth2\OAuth2ServiceProvider');
```

An alternative storage connector using Doctrine can be found at https://github.com/nordsoftware/lumen-oauth2-doctrine.
Then replace the above line `$app->register('Nord\Lumen\OAuth2\Eloquent\EloquentServiceProvider');` with `$app->register('Nord\Lumen\OAuth2\Doctrine\DoctrineServiceProvider');`.

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
