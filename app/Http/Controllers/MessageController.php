<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request){
        $users = User::where('id','!=',Auth::id())
        ->whereHas('roles',function($q){
            $q->whereNotIn('name',['member']);
        })
        ->where(function($q) use($request){
            if(isset($request->q) ){
                $q->orWhere('email', 'LIKE', '%' . $request->q . '%');
                $q->orWhere('name', 'LIKE', '%' . $request->q . '%');

            }

        })
        ->orderBy('name','ASC')->get();
        if (isset($request->receiver_id) && $request->receiver_id && is_numeric($request->receiver_id)){
            $receiver = User::find($request->receiver_id);
            $chat_history = Message::with('sender','receiver')
                ->where(function ($q) use($request){

                    $q->where('sender_id',Auth::id());
                    $q->orWhere('receiver_id',Auth::id());
                })->where(function ($q) use($request){

                    $q->where('sender_id',$request->receiver_id);
                    $q->orWhere('receiver_id',$request->receiver_id);
                })->orderBy('created_at','ASC')
                ->get()->take(15);
        }else{
            $receiver = array();
            $chat_history = array();
        }



        $messagedUsers = Message::with('sender','receiver')->where(function ($q) use($request){

            $q->where('sender_id',Auth::id());
            $q->orWhere('receiver_id',Auth::id());
        })->distinct(['receiver_id'])->orderBy('created_at','DESC')->get(['receiver_id','sender_id']);

        return view('admin.message',compact('users','request','receiver','chat_history','messagedUsers'));
    }

    public function getMessegedUser(Request $request){
        $records = Message::with('sender','receiver')->where(function ($q) use($request){

            $q->where('sender_id',Auth::id());
            $q->where('receiver_id',Auth::id());
        })->distinct('receiver_id')->orderBy('created_at','DESC')->get(['receiver_id']);

        return $records;

    }

    public function FetchChatMessage(Request $request){

        $last_fetched_id = $request->last_fetched_id??0;

        $records = Message::with('sender','receiver')->where(function ($q) use($request){

            $q->where('sender_id',Auth::id());
            $q->orWhere('receiver_id',Auth::id());
        })->where(function ($q) use($request){

            $q->where('sender_id',$request->receiver_id);
            $q->orWhere('receiver_id',$request->receiver_id);
        })->where('id','>',$last_fetched_id)->orderBy('created_at','ASC')->get();
        return $records;
    }

    public function SubmitChatMessage(Request $request){
        $this->validate($request,[
            'receiver_id'=>'required',
            'message'=>'required',
        ]);

        $message = new Message();

        $message->sender_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->status = 'read';
        $message->save();

        return 'success';
    }
}
