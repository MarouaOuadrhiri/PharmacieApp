<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Medicaments extends Model
{
    use HasFactory,HasApiTokens,Notifiable;
    public $table ='medicaments';
    protected $fillable = [
        'id',
        'categorie',
        'nom',
        'general',
        'details',
    ];
}
