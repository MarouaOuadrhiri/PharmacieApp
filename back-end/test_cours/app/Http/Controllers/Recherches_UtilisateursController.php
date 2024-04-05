<?php



namespace App\Http\Controllers;

use App\Models\PharmacistDeviceToken;
use App\Models\RechercheUtilisateur;
use Illuminate\Http\Request;


class Recherches_UtilisateursController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'medicament_id' => 'required|exists:medicaments,id',
        ]);

        $recherche = RechercheUtilisateur::create([
            'utilisateur_id' => $request->input('utilisateur_id'),
            'medicament_id' => $request->input('medicament_id'),
            'listPharmaciesDispo' => json_encode([]), // Convert array to JSON format
        ]);

        return response()->json($recherche, 201);
    }
   /* protected function sendNewMissionNotification($id)
{
    $token='dCauSwUWSMK-uiMq2YkxMN:APA91bEOCYaxdNU2YbHhHGdWY2yg-zZP7qcKQNRgUl7fPLaCm5inb9vgyZswYyeL7GPA3aDN2SI3c--_kHOcf3C3v4TKG8M3_DxITMEEfOjabdyps7R8WJh-4fVHzuubE4WZD20ToBEK';
   // $tokens = PharmacistDeviceToken::pluck('token')->toArray();

    // Create a new notification
    $notification = new NotificationsFirebaseNotification();

    // foreach ($tokens as $token) {
    
    // Send the notification using Firebase
    $message = ([
        'token' => $token,
        'notification' => [
          'title' => 'WeCASH ',
           'body' => "Une nouvelle mission a été ajoutée. Découvrez-la maintenant !",
          ],
       ]);
    Firebase::messaging()->send($message);
//}

}*/
    public function show($id)
    {
        $recherche = RechercheUtilisateur::findOrFail($id);
        return response()->json($recherche);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'exists:users,id',
            'medicament_id' => 'exists:medicaments,id',
            'listPharmaciesDispo' => 'json',
        ]);

        $recherche = RechercheUtilisateur::findOrFail($id);
        $recherche->update($request->all());

        return response()->json($recherche, 200);
    }
    public function destroy($id)
    {
        $recherche = RechercheUtilisateur::findOrFail($id);
        $recherche->delete();

        return response()->json(null, 204);
    }
    public function ajouterPharmacieDispo(Request $request, $utilisateurId, $medicamentId)
    {
        $nouvellePharmacieId = $request->input('pharmacie_id');
    
        $rechercheUtilisateur = RechercheUtilisateur::where('utilisateur_id', $utilisateurId)
                                                    ->where('medicament_id', $medicamentId)
                                                    ->first();
    
        if ($rechercheUtilisateur) {
            // Récupérer la liste de pharmacies disponibles
            $listePharmaciesDispo = $rechercheUtilisateur->listPharmaciesDispo ?? [];
    
            // Ajouter le nouvel ID à la liste
            $listePharmaciesDispo[] = $nouvellePharmacieId;
    
            // Mettre à jour la liste des pharmacies disponibles
            $rechercheUtilisateur->listPharmaciesDispo = $listePharmaciesDispo;
    
            // Sauvegarder les modifications
            $rechercheUtilisateur->save();
    
            return response()->json(['message' => 'Pharmacie ajoutée avec succès'], 200);
        } else {
            return response()->json(['message' => 'Recherche utilisateur non trouvée'], 404);
        }
    }
}


