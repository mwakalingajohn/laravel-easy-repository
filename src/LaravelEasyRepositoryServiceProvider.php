<?php

namespace Mwakalingajohn\LaravelEasyRepository;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mwakalingajohn\LaravelEasyRepository\Commands\LaravelEasyRepositoryCommand;

class LaravelEasyRepositoryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-easy-repository')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-easy-repository_table')
            ->hasCommand(LaravelEasyRepositoryCommand::class);
    }
}
