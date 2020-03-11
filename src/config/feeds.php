<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cache Location
    |--------------------------------------------------------------------------
    |
    | Filesystem path to use for caching, the default should be acceptable in
    | most cases.
    |
    */
    'cache.location'           => storage_path('framework/cache'),

    /*
    |--------------------------------------------------------------------------
    | Cache Life
    |--------------------------------------------------------------------------
    |
    | Life of cache, in seconds
    |
    */
    'cache.life'               => 3600,

    /*
    |--------------------------------------------------------------------------
    | Cache Disabled
    |--------------------------------------------------------------------------
    |
    | Whether to disable the cache.
    |
    */
    'cache.disabled'           => false,

    /*
    |--------------------------------------------------------------------------
    | Disable Check for SSL certificates (enable for self signed certificates)
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'ssl_check.disabled'       => false,

    /*
    |--------------------------------------------------------------------------
    | Strip Html Tags Disabled
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'strip_html_tags.disabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Stripped Html Tags
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'strip_html_tags.tags'     => [
        'base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input',
        'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style',
    ],

    /*
    |--------------------------------------------------------------------------
    | Strip Attributes Disabled
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'strip_attribute.disabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Stripped Attributes Tags
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'strip_attribute.tags'    => [
        'bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout',
        'onfocus', 'onblur', 'lowsrc', 'dynsrc',
    ],

    /*
    |--------------------------------------------------------------------------
    | CURL Options
    |--------------------------------------------------------------------------
    |
    | Array of CURL options (see curl_setopt())
    | Set to null to disable
    |
    */
    'curl.options'             => null,

    'curl.timeout' => null,

];
