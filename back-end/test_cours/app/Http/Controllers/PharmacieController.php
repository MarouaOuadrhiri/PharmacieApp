<?php

namespace App\Http\Controllers;

use App\Http\Resources\PharmacieResource;
use App\Models\Pharmacie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PharmacieController extends Controller
{
    public function index(){
        $pharmacie=Pharmacie::all();
        if($pharmacie->count() > 0){
            return response()->json([
                'status'=>200,
                'pharmacie'=>$pharmacie
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'pharmacie'=>'Not found'
            ],404);
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'Inbe'=>'required|string',
                'NomPhar'=>'required|string',
                'Adresse'=>'required|string',
                'email'=>'required|unique:pharmacies,email',
                'NumTele'=>'required|string',
                'NumFx'=>'required|string',
                'VillePh'=>'required',
                'password' => 'required|string|min:8',
            ]);

            DB::beginTransaction();

            $user = Pharmacie::create([

                'Inbe'=>$request->Inbe,
                'NomPhar'=>$request->NomPhar,
                'Adresse'=>$request->Adresse,
                'email'=>$request->email,
                'NumTele'=>$request->NumTele,
                'NumFx'=>$request->NumFx,
                'VillePh'=>$request->VillePh,
                'password'=> bcrypt($request->password),
            ]);

            DB::commit();

            return response()->json(['user' => $user], 201);
        } catch (ValidationException $e) {
            DB::rollback();
            return response()->json(['message' => 'Validation error', 'errors' => $e->validator->getMessageBag()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'User creation failed', 'error' => $e->getMessage()], 500);
        }
    }

        public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('Pharmacie')->attempt($credentials)) {
                $user = Auth::guard('Pharmacie')->user();
                $token = $user->createToken('authToken')->accessToken;
        
                return response()->json(['token' => $token, 'user' => $user], 200);
            } else {
                $existingUser = Auth::guard('Pharmacie')->getProvider()->retrieveByCredentials(['email' => $credentials['email']]);
        
                if (!$existingUser) {
                    return response()->json(['error' => 'Invalid email'], 401);
                } else {
                    return response()->json(['error' => 'Invalid password'], 401);
                }
            }
        }
        public function logout(Request $request)
        {
        $user = $request->user();

        if ($user) {
            $user->tokens->each(function ($token) {
                $token->revoke();
            });

            return response()->json(['message' => 'Logout successful'], 200);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
        }

        public function current()  {
            return new PharmacieResource(auth()->user());
        }




        
        //dyali
        public function fetchInbe(Request $request)
{
    // Valider les données de la requête
    $request->validate([
        'email' => 'required|email', // Ajoutez d'autres règles de validation au besoin
        // Ajoutez d'autres champs d'identification si nécessaire
    ]);

    // Récupérer les informations du pharmacien à partir de son adresse e-mail
    $pharmacie = Pharmacie::where('email', $request->email)->first();

    if ($pharmacie) {
        // Le pharmacien a été trouvé dans la base de données
        $inbe = $pharmacie->inbe;

        return response()->json(['inbe' => $inbe], 200);
    } else {
        // Le pharmacien n'existe pas dans la base de données
        return response()->json(['error' => 'Pharmacist not found'], 404);
    }
}
public function ajouterNotification(Request $request, $inbe)
{
    // Valider les données de la requête
    $request->validate([
        'contenu' => 'required|string',
    ]);

    // Récupérer la pharmacie
    $pharmacie = Pharmacie::where('inbe', $inbe)->first();

    // Vérifier si la pharmacie existe
    if (!$pharmacie) {
        return response()->json(['message' => 'Pharmacie non trouvée'], 404);
    }

    // Récupérer les notifications existantes de la pharmacie et décoder en tableau PHP
    $notificationsExistantes = json_decode($pharmacie->notifications, true) ?? [];

    // Créer la nouvelle notification
    $nouvelleNotification = [
        'contenu' => $request->input('contenu'),
        'est_lire' => false
    ];

    // Ajouter la nouvelle notification à la liste existante
    $notificationsExistantes[] = $nouvelleNotification;

    // Réencoder le tableau en JSON
    $notificationsJson = json_encode($notificationsExistantes);

    // Mettre à jour les notifications de la pharmacie avec la nouvelle liste
    $pharmacie->notifications = $notificationsJson;

    // Sauvegarder les modifications
    $pharmacie->save();

    // Répondre avec un message de succès
    return response()->json(['message' => 'Notification ajoutée avec succès'], 200);
}
    public function getDatabyInbe(Request $request, $inbe)
    {
        

        // Recherche du pharmacien par son INBE
        $pharmacie = Pharmacie::where('inbe', $inbe)->first();

        if (!$pharmacie) {
            return response()->json(['message' => 'Pharmacie non trouvée'], 404);
        }

        return response()->json(['pharmacie' => $pharmacie], 200);
    }
}
