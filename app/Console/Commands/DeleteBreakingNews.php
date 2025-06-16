<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteBreakingNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:delete';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all news data daily at night';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('breaking_news')->truncate();
    }
}
