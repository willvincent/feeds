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
    'providers' => [
        // ...
        'willvincent\Feeds\FeedsServiceProvider',
    ],
```

Find the `aliases` key in your `config/app.php` and register the Facade.
```php
    'aliases' => [
        // ...
        'Feeds'    => 'willvincent\Feeds\Facades\Feeds',
    ],
```

## Usage

Run `php artisan vendor:publish` to publish the default config file, edit caching setting withing the resulting `config/feeds.php` file as desired.

See [SimplePie Documentation](http://simplepie.org/wiki/) for full API usage documentation.

```php
$feed = Feeds::make('http://feed/url/goes/here');

/**
 * Some useful methods:
 */

$feed->get_permalink(); // Perma-link for the feed

$feed->get_title(); // Get the feed title

$feed->get_description(); // Get the feed's description

$feed->get_items(); // Get items from the feed.
```


If you were to pass `$feed->get_items()` to a view as `$items` you could iterate through them to build a list of articles like this:
```php
@foreach ($items as $item)
  <div class="item">
    <h2><a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></h2>
    <p>{{ $item->get_description() }}</p>
    <p><small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small></p>
  </div>
@endforeach
```
