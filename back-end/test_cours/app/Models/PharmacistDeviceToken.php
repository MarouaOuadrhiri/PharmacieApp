<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PharmacistDeviceToken extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    
    protected $fillable = ['token', 'Pinbe'];
}

