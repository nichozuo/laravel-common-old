<?php

namespace Nichozuo\LaravelCommon\DevTools\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RenameMigrationFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RenameMigrationFiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @return void
     */
    public function handle()
    {
        $migrationPath = database_path('migrations/');
        $files = File::allFiles($migrationPath);
        foreach ($files as $file) {
            $oldFileName = $file->getFilename();
            if ($this->inBlackList($oldFileName))
                continue;
            $newFileName = $this->getNewFilename($oldFileName);
            File::move($migrationPath . $oldFileName, $migrationPath . $newFileName);
            $this->line("$oldFileName ==> $newFileName");
        }
    }

    /**
     * @param string $oldFileName
     * @return string
     */
    private function getNewFilename(string $oldFileName): string
    {
        $arr = explode('_', $oldFileName);
        $arr[0] = '2022';
        $arr[1] = '07';
        $arr[2] = '01';
        $arr[3] = '000000';
        return implode('_', $arr);
    }

    /**
     * @param string $oldFileName
     * @return bool
     */
    private function inBlackList(string $oldFileName): bool
    {
        $blacklists = ['create_failed_jobs_table', 'create_personal_access_tokens_table'];
        foreach ($blacklists as $list) {
            if (Str::contains($oldFileName, $list))
                return true;
        }
        return false;
    }
}
