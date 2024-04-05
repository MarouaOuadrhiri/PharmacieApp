<?php

namespace App\Http\Controllers;

use App\Models\Medicaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentController extends Controller
{
    public function getAll(){
        $medicaments = Medicaments::all();
        return response()->json($medicaments);
    }

    public function showById($id)
    {
        $medicament = Medicaments::find($id);
        if (!$medicament) {
            return response()->json(['message' => 'Medicament not found'], 404);
        }
        return response()->json($medicament);
    }

    public function showByCategory($category){
        $medicament=Medicaments::where('category',$category)->get();
        if(!$medicament){
            return response()->json(['message'=>'Medicament not found'],404);
        }
        return response()->json($medicament);
    }

    
    // public function insertDataFromJson()
    // {
    //     // Lire le contenu du fichier JSON
    //     //hnaya dir lien dyalk jsonwla lmohim li bghiti
    //     $jsonData = file_get_contents('C:\Users\Aya Bentiri\Desktop\medicaments.json');
    
        
    //     $data = json_decode($jsonData, true);
    
        
    //     foreach ($data as $item) {
    //         DB::table('medicaments')->insert([
    //             'categorie'=>$item['Category'],
    //             'nom' => $item['name'],
    //             'general' => $item['general'], 
    //             'details' => json_encode($item['details']), 
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
    
    //     return response()->json(['message' => 'Données insérées avec succès'], 200);
    // }
    public function getAllMedicaments()
    {
        // Récupérer toutes les données de la table "medicaments"
        $medicaments = Medicaments::all();
        
        // Retourner les données sous forme de réponse JSON
        return response()->json($medicaments, 200);
    }
    public function index($category)
    {
        $medicament=Medicaments::where('Category',$category)->get();
        if(!$medicament){
            return response()->json(['message'=>'Medicament not found'],404);
        }
        return response()->json($medicament);
    }
  

    public function showByName($name)
    {
        $medicaments = Medicaments::where('name', 'like', $name . '%')->get();
        if ($medicaments->isEmpty()) {
            return response()->json(['message' => 'No medicaments found for the specified name'], 404);
        }
        return response()->json($medicaments);
    }

}
