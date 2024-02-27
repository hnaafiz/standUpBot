<?php

namespace App\Telegram\Conversations;

use App\Models\User;
use App\Models\TelegramUser;
use SergiX44\Nutgram\Nutgram;
use Illuminate\Support\Facades\Storage;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;




class standUpConvo extends Conversation
{

    protected ?string $step = 'askTodaysTask';

    public $todaysTask;
    public $forwardMessage;

    public function askTodaysTask(Nutgram $bot)
    {
        if (!TelegramUser::where('user_id', $bot->message()->from->id)->first()) {
            $bot->sendMessage("subscribe to continue \n /subscribe");
            return;
        }


        $bot->sendMessage('What will you do today?');


        $this->next('askObstacle');
    }

    public function askObstacle(Nutgram $bot)
    {

        $this->todaysTask = $bot->message()->text;



        $bot->sendMessage('Anything blocking your progress?');

        $this->next('confirmMessageForward');
    }

    public function confirmMessageForward(Nutgram $bot)
    {
        $obstacle = $bot->message()->text;
        $this->forwardMessage = "Today's Task: $this->todaysTask\n";
        $this->forwardMessage .= "Obstacle: $obstacle";

        $bot->sendMessage(
            text: $this->forwardMessage,
            reply_markup: InlineKeyboardMarkup::make()
                ->addRow(InlineKeyboardButton::make('send', callback_data: 'S'), InlineKeyboardButton::make('cancle', callback_data: 'C'))
        );
        $this->next('MessageForward');
    }

    public function MessageForward(Nutgram $bot)
    {


        if ($bot->callbackQuery()->data === 'C') {
            $this->end();
        }

        if ($bot->callbackQuery()->data === 'S') {

            $user = TelegramUser::where('user_id', $bot->callbackQuery()->from->id)->first();

            //Storage::disk('local')->put('callback.txt', json_encode($bot->callbackQuery()));

            $bot->sendMessage(
                text: "@" . $bot->callbackQuery()->from->username . "\n" . $this->forwardMessage,
                chat_id: $user->channel_id
            );

            $this->end();
        }
    }

    // public function closing(Nutgram $bot)
    // {
    //     $bot->sendMessage('Bye!');
    // }
}
