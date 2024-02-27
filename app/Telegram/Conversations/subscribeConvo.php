<?php

namespace App\Telegram\Conversations;

use App\Models\TelegramUser;
use App\Models\User;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Conversations\Conversation;

class subscribeConvo extends Conversation
{
    public function start(Nutgram $bot)
    {
        if (TelegramUser::where('user_id', $bot->message()->from->id)->first()) {
            $bot->sendMessage('User already subscribed');
            return;
        }


        TelegramUser::create([
            'user_id' => $bot->message()->from->id,
            'first_name' =>  $bot->message()->from->first_name,
            'last_name' => $bot->message()->from->last_name,
            'username' => $bot->message()->from->username,
            'subscribe' => true
        ]);
        $bot->sendMessage('Please send the channel or group handle where you want the standup message to be forwarded.');
        $this->next('secondStep');
    }

    public function secondStep(Nutgram $bot)
    {

        TelegramUser::where('user_id', $bot->message()->from->id)
            ->update(['channel_id' =>  $bot->message()->text]);

        $bot->sendMessage('subscribed');
        $this->end();
    }
}
