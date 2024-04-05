<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MessageController extends Controller
{
    public function saveMsg(Request $request){
        $rules=[
            'body'=>'required|string',
            'sender_id'=>'required|int',
            'conversation_id'=>'required|int|exists:conversations,id',
        ];
        $request->validate($rules);
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $message=new Message();
        $message->body=$request['body'];
        $message->read=false;
        $message->type='Pharmcie';
        $message->conversation_id=intval($request['conversation_id']);
        $message->sender_id=intval($request['sender_id']);

        $message->save();
        return new MessageResource($message);
        
    }

    public function saveMsgUs(Request $request){
        $rules=[
            'body'=>'required|string',
            'sender_id'=>'required|int',
            'conversation_id'=>'required|int|exists:conversations,id',
        ];
        $request->validate($rules);
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $message=new Message();
        $message->body=$request['body'];
        $message->read=false;
        $message->type="Utilisateur";
        $message->conversation_id=intval($request['conversation_id']);
        $message->sender_id=intval($request['sender_id']);

        $message->save();
        return new MessageResource($message);
        
    }
}
