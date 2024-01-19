<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


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

Route::middleware('auth:sanctum')->group(function () {
    // Route pour récupérer les informations du visiteur connecté
    Route::get('/auth/user', [AuthController::class, 'getUserInfo']);
    Route::put('/auth/user', [AuthController::class, 'updateUserInfo']);
    Route::get('/auth/rdv/historique', [AuthController::class, 'getHistoriqueRDV']);
    Route::get('/auth/rdv/attente', [AuthController::class, 'getEnAttenteRDV']);
    Route::get('/auth/rdv/accepte', [AuthController::class, 'getAccepteRDV']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    

    // Autres routes nécessitant une authentification
});

Route::post('/auth/login', [AuthController::class, 'login']); // Ajout de l'action 'login'
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/user/count', [AuthController::class, 'getUserCount']);
Route::get('/auth/professionnel/count', [AuthController::class, 'getProfessionnelCount']);
Route::get('/auth/rdv/count', [AuthController::class, 'getRDVCount']);
Route::post('/auth/rechercher', [AuthController::class, 'rechercher']);
Route::get('/creneaux-horaires/{professionId}', [AuthController::class, 'getCreneauxHoraires']);
Route::get('/visiteurs', [AuthController::class, 'getVisiteurs']);
Route::post('/auth/rdv/create', [AuthController::class, 'createRDV']);
Route::put('/update-creneau-status', [AuthController::class, 'updateCreneauStatus']);