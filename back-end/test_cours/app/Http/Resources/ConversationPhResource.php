<?php

namespace App\Http\Resources;

use App\Models\Pharmacie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationPhResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data['id']=$this->id;
        $data['utilisateur_id']=$this->utilisateur_id;
        $data['pharmacie'] = new PharmacieResource(Pharmacie::find($this->pharmacie_id));
        $data['pharmacie_id']=$this->pharmacie_id;
        $data['messages']=MessageResource::collection($this->messages);
        return $data;
    }
}
