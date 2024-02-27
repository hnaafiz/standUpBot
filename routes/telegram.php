<?php

/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Models\User;
use SergiX44\Nutgram\Nutgram;
use Illuminate\Support\Facades\Route;
use App\Telegram\Conversations\standUpConvo;
use App\Telegram\Conversations\subscribeConvo;
/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->onCommand('start', standUpConvo::class);

$bot->onCommand('subscribe', subscribeConvo::class);
