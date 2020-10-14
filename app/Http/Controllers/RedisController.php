<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongBao;
use App\Events\RedisEvent;


class RedisController extends Controller
{
    public function index(){
        $messages = ThongBao::orderBy('created_at', 'desc')->limit(2)->get();

        return view('messages',compact('messages'));
    }

    public function postSendMessage(Request $request){
        $mes = ThongBao::create($request->all());
        event(
            $e = new RedisEvent($mes)
        );

        return redirect()->back();
    }
}
