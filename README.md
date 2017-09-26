# Laravel 5 Feeds

[![Latest Stable Version](https://poser.pugx.org/willvincent/feeds/v/stable.svg)](https://packagist.org/packages/willvincent/feeds)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9098208d-abd1-44ea-af47-a0c42a01cb75.svg?style=flat-square)](https://insight.sensiolabs.com/projects/9098208d-abd1-44ea-af47-a0c42a01cb75)
[![License](https://poser.pugx.org/willvincent/feeds/license.svg)](https://packagist.org/packages/willvincent/feeds)

[![Total Downloads](https://poser.pugx.org/willvincent/feeds/downloads.svg)](https://packagist.org/packages/willvincent/feeds) [![Monthly Downloads](https://poser.pugx.org/willvincent/feeds/d/monthly.png)](https://packagist.org/packages/willvincent/feeds) [![Daily Downloads](https://poser.pugx.org/willvincent/feeds/d/daily.png)](https://packagist.org/packages/willvincent/feeds)

A simple [Laravel 5](http://www.laravel.com/) service provider for including the [SimplePie](http://www.simplepie.org) library.

## Installation

The Laravel 5 Feeds Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`willvincent/feeds` package in your project's `composer.json`.

```json
{
    "require": {
        "willvincent/feeds": "1.1.*"
    }
}
```

## Configuration

> If you're using Laravel 5.5 you may skip the next step.

To use the Feeds Service Provider, you must register the provider when bootstrapping your Laravel application.

Find the `providers` key in your `config/app.php` and register the Service Provider.

```php
    'providers' => [
        // ...
        willvincent\Feeds\FeedsServiceProvider::class,
    ],
```

Find the `aliases` key in your `config/app.php` and register the Facade.
```php
    'aliases' => [
        // ...
        'Feeds'    => willvincent\Feeds\Facades\FeedsFacade::class,
    ],
```

## Usage

Run `php artisan vendor:publish --provider="willvincent\Feeds\FeedsServiceProvider"` to publish the default config file, edit caching setting withing the resulting `config/feeds.php` file as desired.

See [SimplePie Documentation](http://simplepie.org/wiki/) for full API usage documentation.

The make() accepts 3 paramaters, the first parameter is an array of feed URLs, the second parameter is the max number of items to be returned per feed, and while the third parameter is a boolean which you can set to force to read unless content type not a valid RSS.

```php
$feed = Feeds::make('http://feed/url/goes/here');
```


###### Note: In Laravel 5, Facades must either be prefixed with a backslash, or brought into scope with a `use [facadeName]` declaration.


### Example controller method, and it's related view:

Controller:
```php
  public function demo() {
    $feed = Feeds::make('http://blog.case.edu/news/feed.atom');
    $data = array(
      'title'     => $feed->get_title(),
      'permalink' => $feed->get_permalink(),
      'items'     => $feed->get_items(),
    );

    return View::make('feed', $data);
  }
```

or Force to read unless content type not a valid RSS

```php
  public function demo() {
    $feed = Feeds::make('http://blog.case.edu/news/feed.atom', true); // if RSS Feed has invalid mime types, force to read
    $data = array(
      'title'     => $feed->get_title(),
      'permalink' => $feed->get_permalink(),
      'items'     => $feed->get_items(),
    );

    return View::make('feed', $data);
  }
```

### Multifeeds example controller method, and it's related view:

Controller:
```php
  public function demo() {
    $feed = Feeds::make([
        'http://blog.case.edu/news/feed.atom',
        'http://tutorialslodge.com/feed'
    ], 5);
    $data = array(
      'title'     => $feed->get_title(),
      'permalink' => $feed->get_permalink(),
      'items'     => $feed->get_items(),
    );

    return View::make('feed', $data);
  }
```

or Force to read unless content type not a valid RSS

```php
  public function demo() {
        $feed = Feeds::make(['http://blog.case.edu/news/feed.atom',
        'http://tutorialslodge.com/feed'
    ], 5, true); // if RSS Feed has invalid mime types, force to read
    $data = array(
      'title'     => $feed->get_title(),
      'permalink' => $feed->get_permalink(),
      'items'     => $feed->get_items(),
    );

    return View::make('feed', $data);
  }
```

View:
```php
@extends('app')

@section('content')
  <div class="header">
    <h1><a href="{{ $permalink }}">{{ $title }}</a></h1>
  </div>

  @foreach ($items as $item)
    <div class="item">
      <h2><a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></h2>
      <p>{{ $item->get_description() }}</p>
      <p><small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small></p>
    </div>
  @endforeach
@endsection
```
