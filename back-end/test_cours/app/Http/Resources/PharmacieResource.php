<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data['id']=$this->id;
        $data['Inbe']=$this->Inbe;
        $data['NomPhar']=$this->NomPhar;
        $data['email']=$this->email;
        $data['VillePh']=$this->VillePh;
        return $data;
    }
}
