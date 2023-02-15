<?php

namespace App\Http\Controllers;

use App\Models\Message;
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
}
