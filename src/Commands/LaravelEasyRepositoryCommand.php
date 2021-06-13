<?php

namespace Mwakalingajohn\LaravelEasyRepository\Commands;

use Illuminate\Console\Command;

class LaravelEasyRepositoryCommand extends Command
{
    public $signature = 'laravel-easy-repository';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
