<?php

namespace Vanry\Sitemap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see  \Vanry\Sitemap\Sitemap
 */
class Sitemap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public function getFacadeAccesser()
    {
        return 'sitemap';
    }
}
