<?php

namespace Nichozuo\LaravelCommon\DevTools\Commands;

use Illuminate\Console\Command;
use Nichozuo\LaravelCommon\DevTools\Helpers\TableHelper;
use Psr\SimpleCache\InvalidArgumentException;

class ClearDBCacheCommand extends Command
{
    protected $signature = 'db:cache';
    protected $description = 'clean the db cache files';

    /**
     * @throws InvalidArgumentException
     */
    public function handle()
    {
        TableHelper::ReCache();
    }

}