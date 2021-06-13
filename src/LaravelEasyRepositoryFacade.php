<?php

namespace Mwakalingajohn\LaravelEasyRepository;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mwakalingajohn\LaravelEasyRepository\LaravelEasyRepository
 */
class LaravelEasyRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-easy-repository';
    }
}
