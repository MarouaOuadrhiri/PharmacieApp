<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data['id']=$this->id;
        $data['body']=$this->body;
        $data['read']=$this->read;
        $data['type']=$this->type;
        $data['sender_id']=$this->sender_id;
        $data['conversation_id']=$this->conversation_id;
        $data['created_at']=$this->created_at;
        return $data;
    }
}
