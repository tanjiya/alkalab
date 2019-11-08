<?php

namespace App\Console\Commands;

use App\User;
use App\Notifications\UnreadAnswerInThread;

use Illuminate\Console\Command;

class UnreadAnswer extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'notification:UnreadAnswer';

    /**
     * The console command description.
     */
    protected $description = 'Sent The User An Email of Their Unread Answer';

    /**
     * Create a new command instance.
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
        $users = User::all();

        $users->map(function($user){
            $messages = GetThreadAnswer::new($user);
            
            $user->notify (new UnreadAnswerInThread($messages, $user));
        });
    }
}
