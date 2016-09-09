<?php

namespace LaravelHungary\Announcement\Facades;

use Illuminate\Support\Facades\Facade;

class Announce extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'announce'; }
}
