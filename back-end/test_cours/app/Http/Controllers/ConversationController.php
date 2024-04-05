<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversationPhResource;
use App\Http\Resources\ConversationResource;
use App\Models\conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    public function getAllConv(){
        $conversations=conversation::all();
        // if($conversations[2]->messages->isEmpty()){
        //     return response()->json(['message' => 'Empty conversation'], 404);
        // }
        // return $conversations[2]->messages;
        //to get one
        // return new ConversationResource($conversations[0]);

        //to get many
        return ConversationResource::collection($conversations);
    }

    // public function createConversation(Request $request){
    //     $request->validate([
    //         'pharmacie_id'=>'required',
    //         'message'=>'required',
    //         'utilisateur_id'=>'required',
    //     ]);

    //     $conversations=conversation::create([
    //         'utilisateur_id'=>$request['utilisateur_id'],
    //         'pharmacie_id'=>$request['pharmacie_id'],
    //     ]);
    //     Message::create([
    //         'body'=>$request['message'],
    //         'conversation_id'=>$conversations->id,
    //         'sender_id'=>$request['pharmacie_id'],
    //         'read'=>false
    //     ]);
    //     return new ConversationResource($conversations);
    // }

    // public function createConversation(Request $request) {
    //     try{
    //         $request->validate([
    //         'pharmacie_id' => 'required',
    //         'message' => 'required',
    //         'utilisateur_id' => 'required',
    //     ]);
    

    //     $existingConversation = Conversation::where('pharmacie_id', $request['pharmacie_id'])
    //                                         ->where('utilisateur_id', $request['utilisateur_id'])
    //                                         ->first();
    
    //     if ($existingConversation) {
    //         Message::create([
    //             'body' => $request['message'],
    //             'conversation_id' => $existingConversation->id,
    //             'type'=>'Pharmcie',
    //             'sender_id' => $request['pharmacie_id'],
    //             'read' => false
    //         ]);
    
    //         return new ConversationResource($existingConversation);
    //     }
    //     else{
    //         $conversation = Conversation::create([
    //         'utilisateur_id' => $request['utilisateur_id'],
    //         'pharmacie_id' => $request['pharmacie_id'],
    //     ]);
    
    //     Message::create([
    //         'body' => $request['message'],
    //         'conversation_id' => $conversation->id,
    //         'sender_id' => $request['pharmacie_id'],
    //         'read' => false
    //     ]);
    
    //     return new ConversationResource($conversation);
    //     }

    //     }
    //     catch
        
        
    

        
    // }

    public function createConversation(Request $request) {
    try {
        $request->validate([
            'pharmacie_id' => 'required',
            'message' => 'required',
            'utilisateur_id' => 'required',
        ]);

        $existingConversation = Conversation::where('pharmacie_id', $request['pharmacie_id'])
                                            ->where('utilisateur_id', $request['utilisateur_id'])
                                            ->first();

        if ($existingConversation) {
            Message::create([
                'body' => $request['message'],
                'conversation_id' => $existingConversation->id,
                'type' => 'Pharmacie',
                'sender_id' => $request['pharmacie_id'],
                'read' => false
            ]);

            return new ConversationResource($existingConversation);
        } else {
            $conversation = Conversation::create([
                'utilisateur_id' => $request['utilisateur_id'],
                'pharmacie_id' => $request['pharmacie_id'],
            ]);

            Message::create([
                'body' => $request['message'],
                'conversation_id' => $conversation->id,
                'sender_id' => $request['pharmacie_id'],
                'type'=>'Pharmacie',
                'read' => false
            ]);

            return new ConversationResource($conversation);
        }
    } catch (Exception $e) {
        // Handle the exception, you can log it or return an error response
        return response()->json(['error' => 'An error occurred while processing the request'], 500);
    }
}



    public function index(Request $request)
	{
		$conversations = Conversation::where('utilisateur_id',auth()->user()->id)->orderBy('updated_at', 'desc')->get();
		$count = count($conversations);
		for ($i = 0; $i < $count; $i++) {
			for ($j = $i + 1; $j < $count; $j++) {
				if (isset($conversations[$i]->messages->last()->id) && isset($conversations[$j]->messages->last()->id) && $conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id) {
					$temp = $conversations[$i];
					$conversations[$i] = $conversations[$j];
					$conversations[$j] = $temp;
				}
			}
		}
		return ConversationPhResource::collection($conversations);
		
	}

    public function indexPh()
	{
		$conversations = Conversation::where('pharmacie_id',auth()->user()->id)->orderBy('updated_at', 'desc')->get();
		$count = count($conversations);
		for ($i = 0; $i < $count; $i++) {
			for ($j = $i + 1; $j < $count; $j++) {
				if (isset($conversations[$i]->messages->last()->id) && isset($conversations[$j]->messages->last()->id) && $conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id) {
					$temp = $conversations[$i];
					$conversations[$i] = $conversations[$j];
					$conversations[$j] = $temp;
				}
			}
		}
		return ConversationResource::collection($conversations);
		
	}
}
