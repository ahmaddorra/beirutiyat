<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $user = Auth::user();
        $likes = User::query()
            ->where('likes', $user->id)
            ->where('_id', '!=', $user->id)
            ->whereNotIn('_id', $user->likes)
            ->whereNotIn('_id', $user->dislikes)
            ->get();
        $matches =  User::query()
            ->where('likes', $user->id)
            ->where('_id', '!=', $user->id)
            ->whereIn('_id', $user->likes)
            ->get();

        $chat = [];
        $exists = false;
        $message = "";
        foreach ($matches as $match){
            $exists = false;
            foreach($match->messages as $message){
                $m = Message::query()->find($message);
                if($m != null){
                    if( ($m->from == $user->id && $m->to == $match->id) || ($m->to == $user->id && $m->from == $match->id)){
                        $exists = true;
                    }

                }
            }
            if($exists == true ){
                array_push($chat, [$match, Message::query()->find($message)]);
            }
        }

        return view('matches', compact(['likes','matches','chat']));
    }
    function like($id){
        $user = Auth::user();
        $user->push('likes', $id);
        return redirect()->route('home');
    }
    function dislike($id){
        $user = Auth::user();
        $user->push('dislikes', $id);
        return redirect()->route('home');
    }
}
