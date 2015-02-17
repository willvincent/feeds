<?php namespace willvincent\Feeds;

use Illuminate\Support\Facades\Facade;

class Feed extends Facade {

    protected static function getFacadeAccessor() { return 'Feeds'; }

}
