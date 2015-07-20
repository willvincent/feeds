<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Strip Html Tags Disabled
  |--------------------------------------------------------------------------
  |
  |
  |
  */
  'strip_html_tags.disabled'=> false,

  /*
  |--------------------------------------------------------------------------
  | Striped Html Tags
  |--------------------------------------------------------------------------
  |
  |
  |
  */
//	'base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style'
  'strip_html_tags.tags'=> [ 'base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style'],

  /*
  |--------------------------------------------------------------------------
  | Cache Location
  |--------------------------------------------------------------------------
  |
  | Filesystem path to use for caching, the default should be acceptable in
  | most cases.
  |
  */
  'cache.location' => storage_path() . '/framework/cache',

  /*
  |--------------------------------------------------------------------------
  | Cache Life
  |--------------------------------------------------------------------------
  |
  | Life of cache, in seconds
  |
  */
  'cache.life'     => 3600,

  /*
  |--------------------------------------------------------------------------
  | Cache Disabled
  |--------------------------------------------------------------------------
  |
  |
  |
  */
  'cache.disabled' => false,

];
