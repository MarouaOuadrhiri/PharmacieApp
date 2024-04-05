<?php

namespace App\Http\Controllers;

use App\Models\PharmacistDeviceToken;
use Illuminate\Http\Request;

class PharmacistDeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        // Validez les données de la requête si nécessaire
        $request->validate([
            'token' => 'required|string',
            'Pinbe' => 'required|string',
        ]);

        // Enregistrez le token de dispositif du pharmacien dans la base de données
        $pharmacistToken = PharmacistDeviceToken::create([
            'token' => $request->token,
            'Pinbe' => $request->Pinbe,
        ]);

        return response()->json(['message' => 'Pharmacist device token stored successfully'], 201);
    }
}

