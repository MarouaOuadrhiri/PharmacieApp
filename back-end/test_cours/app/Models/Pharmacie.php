<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pharmacie extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $fillable = [
        'Inbe',
        'NomPhar',
        'Adresse',
        'VillePh',
        'email',
        'NumTele',
        'NumFx',
        "password",
        "confirmer"
    ];

}
