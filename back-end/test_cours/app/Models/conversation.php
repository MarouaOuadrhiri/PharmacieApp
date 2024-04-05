<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class conversation extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable = [
        'utilisateur_id',
        'pharmacie_id',
    ];
    public function messages(){
        return $this->hasMany("App\Models\Message");
    }
}
