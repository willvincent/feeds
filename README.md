# Laravel 5 Feeds

[![Latest Stable Version](https://poser.pugx.org/willvincent/feeds/v/stable.svg)](https://packagist.org/packages/willvincent/feeds) [![Total Downloads](https://poser.pugx.org/willvincent/feeds/downloads.svg)](https://packagist.org/packages/willvincent/feeds) [![Latest Unstable Version](https://poser.pugx.org/willvincent/feeds/v/unstable.svg)](https://packagist.org/packages/willvincent/feeds) [![License](https://poser.pugx.org/willvincent/feeds/license.svg)](https://packagist.org/packages/willvincent/feeds)

A simple [Laravel 5](http://www.laravel.com/) service provider for including the [SimplePie](http://www.simplepie.org) library.

## Installation

The Laravel 5 Feeds Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`willvincent/feeds` package in your project's `composer.json`.

```json
{
    "require": {
        "willvincent/feeds": "1.0.*"
    }
}
```

## Configuration

To use the Feeds Service Provider, you must register the provider when bootstrapping your Laravel application.

Find the `providers` key in your `config/app.php` and register the Service Provider.

```php
    'providers' => array(
        // ...
        'willvincent\Feeds\FeedsServiceProvider',
    )
```

## Usage

See [SimplePie Documentation](http://simplepie.org/wiki/) for full API usage documentation.

```php
$feed = $this->app->make('Feeds');
```
