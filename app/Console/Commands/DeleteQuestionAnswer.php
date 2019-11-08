<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteQuestionAnswer extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'command:DeleteQuestionAnswer';

    /**
     * The console command description.
     */
    protected $description = 'Delete Question in Every 24Hour';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('questions')->where('created_at', '<=', Carbon::now()->subDay())->delete();

        DB::table('answers')->where('created_at', '<=', Carbon::now()->subDay())->delete();
    }
}
