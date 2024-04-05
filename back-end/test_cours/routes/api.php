<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\PharmacistDeviceTokenController;
use App\Http\Controllers\Recherches_UtilisateursController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilisateurController;
use App\Models\conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/connect',[ApiController::class,'login']);

// Route::post('/connect', [Controller::class, 'logout'])->middleware('auth:api');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('/createUser',[UserController::class,'create']);
Route::post('/loginUser',[UserController::class,'login']);
Route::post('/logoutUser',[UserController::class,'logout'])->middleware('auth:api');


//Utilisateur
Route::post('/create',[UtilisateurController::class,'store']);
Route::get('/index',[UtilisateurController::class,'index']);
Route::post('/login', [UtilisateurController::class, 'login']);
Route::post('/logout', [UtilisateurController::class, 'logout'])->middleware('auth:Utilisateur_api');

//php artisan passport:client --personal
// oauth_clients


//Pharmacie
Route::post('/createPh',[PharmacieController::class,'store']);
Route::get('/pharmacie',[PharmacieController::class,'index']);
Route::post('/loginPh', [PharmacieController::class, 'login']);
Route::post('/logoutPh', [PharmacieController::class, 'logout'])->middleware('auth:Pharmacie_api');


//Medicament api
Route::get("/getAll",[MedicamentController::class,'getAll']);
Route::post("/showById/{id}", [MedicamentController::class, 'showById']);
Route::post("showByCategory/{cat}",[MedicamentController::class,'showByCategory']);
Route::post("showByName/{cat}",[MedicamentController::class,'showByName']);



Route::get("getAllConv",[ConversationController::class,"getAllConv"])->middleware('auth:Pharmacie_api');
Route::get("getAllConv",[ConversationController::class,"getAllConv"])->middleware('auth:Pharmacie_api');



//conversation api
Route::post("/addMessage",[MessageController::class,"saveMsg"])->middleware('auth:Pharmacie_api');
Route::post("/addMessageUs",[MessageController::class,"saveMsgUs"])->middleware('auth:Utilisateur_api');


Route::post("/createConversation",[ConversationController::class,"createConversation"]);
Route::get('conversationsUs',[ConversationController::class,"index"])->middleware('auth:Utilisateur_api');

Route::get('utilisateur',[UtilisateurController::class,'current'])->middleware('auth:Utilisateur_api');
Route::get('pharamcie',[PharmacieController::class,'current'])->middleware('auth:Pharmacie_api');


Route::get('conversations',[ConversationController::class,"indexPh"])->middleware('auth:Pharmacie_api');


//hadchi dyali-aya-
Route::post('/createRecherche',[Recherches_UtilisateursController::class,'store']);
Route::post('/createtoken',[PharmacistDeviceTokenController::class,'store']);
Route::post('/getInbe',[PharmacieController::class,'fetchInbe']);
Route::post('/getID',[UtilisateurController::class,'fetchId']);
Route::get('insertmedicaments', [MedicamentController::class, 'insertDataFromJson']);
Route::get('getmedicaments', [MedicamentController::class, 'getAllMedicaments']);
Route::get('/medicaments/{category}', [MedicamentController::class, 'index']);
Route::post('/getusirinfo/{id}',[UtilisateurController::class,'obtenirInformationsUtilisateur']);

