<?php

namespace Nichozuo\LaravelCommon\DevTools\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Nichozuo\LaravelCommon\DevTools\Helpers\TableHelper;

class UpdateModelsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach (TableHelper::GetTables() as $table) {
            $name = $table->getName();
            $this->line($name . ':::');
            Artisan::call("gf $name -d -f");
        }
    }
}
