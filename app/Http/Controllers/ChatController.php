<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $user = Auth::user();
        $recipient = User::query()->find($id);
        $chat = Message::query()
            ->where(function ($query) use ($user, $recipient) {
                return $query
                    ->where('from', $user->id)
                    ->where('to', $recipient->id);
            })
            ->orWhere(function ($query) use ($user, $recipient) {
                return $query
                    ->where('to', $user->id)
                    ->where('from', $recipient->id);
            })
            ->orderBy('updated_at')
        ->get();
        return view("chat",compact(["recipient","user","chat"]));
    }
    public function send(Request $request){
        $user = Auth::user();
        $recipient = User::query()->find($request->recipient);
        $message = Message::create([
            'from' => $user->id,
            'to' => $request->recipient,
            'text' =>  $request->text
        ]);
        $recipient->push('messages', $message->id);
        $user->push('messages', $message->id);
        //$message->created_at = $message->created_at->toTimeString();
        event(new broadcastMessage($message));
        return response()->json(['success' => 'message sent']);
    }

}
