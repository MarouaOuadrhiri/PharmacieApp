<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medicament;
use App\Models\Utilisateur;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RechercheUtilisateur extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
    

    protected $fillable = ['utilisateur_id', 'medicament_id', 'listPharmaciesDispo'];

    /**
     * Get the utilisateur that owns the recherche utilisateur.
     */
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    /**
     * Get the medicament that belongs to the recherche utilisateur.
     */
    public function medicament()
    {
        return $this->belongsTo(Medicaments::class);
    }
    
}

