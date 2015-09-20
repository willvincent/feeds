# Laravel 5 Feeds

This is a fork of  Will Vincent [Laravel 5 Feeds](https://github.com/willvincent/feeds), I just add option to allow multifeeds and ability to set items to be returned per feed.

## Installation

For installation and configuration read the [doc](https://github.com/willvincent/feeds).

## Usage
The make() accepts 3 paramaters, the first parameter is an array of feed URLs, the second parameter is the max number of items to be returned per feed, and while the third parameter is a boolean which you can set to force to read unless content type not a valid RSS.

### Example controller method, and it's related view:

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
