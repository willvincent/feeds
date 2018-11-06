<?php

namespace willvincent\Feeds\Facades;

use Illuminate\Support\Facades\Facade;

class FeedsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'Feeds';
    }
}
