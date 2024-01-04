<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\DeadlineNotification;

class CheckDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check upcoming , overdue deadlines and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::find(3);
        $user->notify(new DeadlineNotification("hello"));
        // echo "hello";
    }
}
