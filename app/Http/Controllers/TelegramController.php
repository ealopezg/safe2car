<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class TelegramController extends Controller
{

    public function userSetupTelegram(Request $request){
        $user = $request->user();
        $user->telegram_auth_token = Str::random(16);
        $user->save();
        return response('https://t.me/Safe2CarBot?start='.$user->telegram_auth_token);
    }



    public function telegram(Request $request){
        $message = $request->get('message');
        $chat_id = $message['chat']['id'];
        $text = explode(' ',$message['text']);
        if($text[0] == '/start' && isset($text[1])){
            $token = $text[1];
            $user = \App\Models\User::where('telegram_auth_token',$token)->firstOrFail();
            $user->telegram_user_id = $chat_id;
            $user->save();
        }
        return response('OK');
    }
}
