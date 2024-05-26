<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\MessageSent;

class ChatController extends Controller
{
    //
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // Trigger a "message-sent" event with the message data
        event(new MessageSent($message));

        return response()->json(['status' => 'Message Sent!']);
    }
}
