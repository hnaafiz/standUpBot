<?php

namespace App\Console;

use App\Models\TelegramUser;
use App\Telegram\Conversations\standUpConvo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\StartConversation;



class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function (Nutgram $bot) {


            $allUsers = TelegramUser::where('subscribe', true)->get();

            $allUsers->each(function ($user) use ($bot) {
                $bot->sendMessage(
                    text: "start stand Up \n /start ",
                    chat_id: $user->user_id
                );
            });
        })->dailyAt('09:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
