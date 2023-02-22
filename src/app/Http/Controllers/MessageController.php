<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjaxMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index( ){
        $allMessages = Message::all();

        $userMessage = Message::with('user')->where('user_id' , Auth::user()->id)->get();
        
        return view('chat.index' , compact('allMessages' , 'userMessage'));
    }

    public function storageMsg(AjaxMessageRequest $request){
        $validator = $request->validated();

        $msg = Message::create([
            'user_id' => Auth::user()->id,
            'body' => $validator['message'],
        ]);

        return "<li class='d-flex justify-content-between mb-4' id='current-user'> <img src='https://th.bing.com/th/id/OIP.TSmyNYPpLJLvzpTeS4kF6wHaF2?pid=ImgDet&rs=1' class='rounded-circle d-flex align-self-start me-3 shadow-1-strong' width='60'> <div class='card mask-custom'> <div class='card-header d-flex justify-content-between p-3' style='border-bottom: 1px solid rgba(255,255,255,.3);'> <p class=fw-bold mb-0> {$msg->user->name} </p> <p class='text-light small mb-0'><i class='far fa-clock'></i> 12 mins ago</p> </div> <div class='card-body'> <p class='mb-0'> {$msg->body} </p> </div> </div> </li>";
    }
}
