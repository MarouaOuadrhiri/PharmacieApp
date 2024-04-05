<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Message extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable = [
        'body',
        'date',
        'read',
        'type',
        'conversation_id',
        'sender_id',
    ];

    public function conversation(){
        return $this->hasMany("App\Models\conversation");
    }
}
