<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Utilisateur extends Authenticatable
{
   
        
    use HasApiTokens, HasFactory, Notifiable;
    //php artisan install:api --passport


    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'numtel',
        'ville',
        'password',
    ]; 


    // protected $hidden = [
    //     'motDPss',
    //     'remember_token',
    // ];


}






