<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\InactiveUserNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailToInactiveUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-to-inactive-users-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users=User::where('last_login', '<', Carbon::now()->subMonth())->get();
        foreach ($users as $user) {
            $user->notify(new InactiveUserNotification());
        }
    }
}
