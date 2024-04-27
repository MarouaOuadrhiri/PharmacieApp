<?php

namespace App\Http\Controllers;

use App\Models\Pharmacie;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    //
    public function valider($emailUsers){
        $pharmacie = Pharmacie::where("email", $emailUsers)->first();
        if($pharmacie){
            $pharmacie->update(['confirmer' => true]);
            return response()->json(['message' => 'Utilisateur confirmé avec succès'], 200);
        } else {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
    }
}
