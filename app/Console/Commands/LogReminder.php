<?php

namespace App\Console\Commands;

use App\User;
use App\Mail\LogReminderEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class LogReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all users a reminder to log their daily stats.';

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
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::get();

        foreach ($users as $user) {
            Mail::to($user)->send(new LogReminderEmail);
        }
    }
}
