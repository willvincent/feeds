<?php namespace willvincent\Feeds\Facades;

use Illuminate\Support\Facades\Facade;

class FeedsFacade extends Facade {

  protected static function getFacadeAccessor() {
    return 'Feeds';
  }

}
