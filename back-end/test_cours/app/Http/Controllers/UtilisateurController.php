<?php

namespace App\Http\Controllers;

use App\Http\Resources\UtilisateurResource;
use App\Models\Utilisateur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;





class UtilisateurController extends Controller
{
    public function index(){
        $utilisateur=Utilisateur::all();
        if($utilisateur->count() > 0){
            return response()->json([
                'status'=>200,
                'utilisateur'=>$utilisateur
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'utilisateur'=>'Not found'
            ],404);
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom'=>'required|string',
                'prenom'=>'required|string',
                'email'=>'required|unique:utilisateurs,email',
                'numtel'=>'required|string',
                'ville'=>'required',
                'password' => 'required|string|min:8',
            ]);

            DB::beginTransaction();

            $user = Utilisateur::create([

                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'email'=>$request->email,
                'numtel'=>$request->numtel,
                'ville'=>$request->ville,
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
            if (Auth::guard('Utilisateur')->attempt($credentials)) {
                $user = Auth::guard('Utilisateur')->user();
                $token = $user->createToken('authToken')->accessToken;
        
                return response()->json(['token' => $token, 'user' => $user], 200);
            } else {
                $existingUser = Auth::guard('Utilisateur')->getProvider()->retrieveByCredentials(['email' => $credentials['email']]);
        
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
            return new UtilisateurResource(auth()->user());
        }




        public function obtenirInformationsUtilisateur($id)
{
    // Utilisez la méthode statique find() du modèle User pour récupérer l'utilisateur par son id
    $utilisateur = Utilisateur::find($id);

    if ($utilisateur) {
        // Si l'utilisateur est trouvé, vous pouvez accéder à ses propriétés
        $nom = $utilisateur->nom;
        $prenom = $utilisateur->prenom;
        $email=$utilisateur->email;
        $numtel=$utilisateur->numtel;
        $ville=$utilisateur->ville;

        // Vous pouvez également retourner les informations dans une réponse JSON ou les utiliser comme nécessaire
        return response()->json([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' =>$email,
            'numtel'=>$numtel,
            'ville'=>$ville,

        ]);
    } else {
        // Gérer le cas où l'utilisateur n'est pas trouvé
        return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
    }
}
public function fetchId(Request $request)
{
    // Valider les données de la requête
    $request->validate([
        'email' => 'required|email', // Ajoutez d'autres règles de validation au besoin
        // Ajoutez d'autres champs d'identification si nécessaire
    ]);

    // Récupérer les informations du pharmacien à partir de son adresse e-mail
    $user = Utilisateur::where('email', $request->email)->first();

    if ($user) {
        // Le pharmacien a été trouvé dans la base de données
        $id = $user->id;

        return response()->json(['id' => $id], 200);
    } else {
        // Le pharmacien n'existe pas dans la base de données
        return response()->json(['error' => 'Pharmacist not found'], 404);
    }
}

    public function delete($id){
        $utilisateur = Utilisateur::find($id);
        if (!$utilisateur) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }
    
        // Supprimer l'utilisateur
        $utilisateur->delete();
    
        // Retourner une réponse JSON pour indiquer que la suppression a été effectuée avec succès
        return response()->json(['message' => 'Utilisateur supprimé avec succès.'], 200);
    
    }
}






