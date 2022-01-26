<?php

namespace Nichozuo\LaravelCommon\DevTools\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ISeedBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:iseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'iseed backup command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $list = config('common.iSeedBackupList', []);
        foreach ($list as $item) {
            $this->line("backup:::$item");
            Artisan::call("iseed $item --force");
        }
    }
}
