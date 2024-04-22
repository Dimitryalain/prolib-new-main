<?php

use App\Http\Controllers\ResetProfessionnelPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Auth\ProfessionnelAuthController;
use App\Http\Controllers\Auth\ProfessionnelRegisterController;
use App\Http\Controllers\Auth\VisiteurLoginController;
use App\Http\Controllers\Auth\VisiteurRegisterController;
use App\Http\Controllers\Auth\VisiteurAuthController;
use App\Models\Visiteur;
use App\Models\RDV;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\NoteController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', function () {
    $CountProfessionnels = App\Models\Profession::CountProfessionnels();
    $countRDV = App\Models\RDV::countRDV();
    $countVisiteur = Visiteur::countVisiteur();
    return view('welcome', compact('CountProfessionnels','countRDV','countVisiteur'));
});

Route::get('contact', 
[App\Http\Controllers\Controller::class, 'contact'])
->name('contact');

Route::get('welcome', 
[App\Http\Controllers\Controller::class, 'welcome'])
->name('welcome');


Route::get('admin.clients', 
[App\Http\Controllers\AdminController::class, 'clients'])
->name('clients');

Route::get('admin.notations', 
[App\Http\Controllers\AdminController::class, 'notations'])
->name('notations');

Route::get('admin.tdb', 
[App\Http\Controllers\AdminController::class, 'tdb'])
->name('tdb');

Route::get('admin.demande', 
[App\Http\Controllers\AdminController::class, 'demande'])
->name('demande');

Route::get('admin.audit', 
[App\Http\Controllers\AdminController::class, 'audit'])
->name('audit')
->middleware("can:Administrateur");

Route::get('admin.suivi', 
[App\Http\Controllers\AdminController::class, 'suivi'])
->name('suivi');

Route::get('admin.professionnel', 
[App\Http\Controllers\AdminController::class, 'professionnel'])
->name('professionnel');

Route::get('admin.avis', 
[App\Http\Controllers\AdminController::class, 'avis'])
->name('avis');

// Dans le fichier de routes
Route::get('admin.infos', 
[App\Http\Controllers\AdminController::class, 'infos'])
->name('infos');


// RECHERCHE ENTRE DEUX DATES 

Route::post('/professionnel/recherche', 
[App\Http\Controllers\AdminController::class, 'recherche'])
->name('professionnel.recherche');

Route::post('/suivi_rdv/recherche', 
[App\Http\Controllers\AdminController::class, 'recherche_rdv'])
->name('suivi_rdv.recherche');

Route::post('/client/recherche', 
[App\Http\Controllers\AdminController::class, 'recherche_client'])
->name('client.recherche');

Route::post('/demande_rdv/recherche', 
[App\Http\Controllers\AdminController::class, 'recherche_demande'])
->name('demande_rdv.recherche');

Route::post('/client_professionnel/recherche', 
[App\Http\Controllers\ProfessionelController::class, 'recherche_client_professionnel'])
->name('client_professionnel.recherche');

Route::post('/suivi_rdv_professionnel/recherche', 
[App\Http\Controllers\ProfessionelController::class, 'recherche_suivi_rdv_professionnel'])
->name('suivi_rdv_professionnel.recherche');





Route::get('admin.employe', 
[App\Http\Controllers\AdminController::class, 'employe'])
->name('employe');

Route::get('admin.profil', 
[App\Http\Controllers\AdminController::class, 'profil'])
->name('profil');

Route::put('/update-profil', [App\Http\Controllers\AdminController::class, 'update_profil'])
    ->name('update_profil');

Route::get('admin.changerMotPasse', 
[App\Http\Controllers\AdminController::class, 'changerMotPasse'])
->name('changerMotPasse');

Route::post('admin.updatePassword', 
[App\Http\Controllers\AdminController::class, 'updatePassword'])
->name('updatePassword');

Route::get('users/{id}/activate', 
[App\Http\Controllers\AdminController::class, 'activate'])
->name('activate-users');

Route::get('users/{id}/deactivate', 
[App\Http\Controllers\AdminController::class, 'deactivate'])
->name('deactivate-users');

Route::get('clients/{id}/activate', 
[App\Http\Controllers\AdminController::class, 'activate_clients'])
->name('activate-clients');

Route::get('clients/{id}/deactivate', 
[App\Http\Controllers\AdminController::class, 'deactivate_clients'])
->name('deactivate-clients');

Route::get('professionnels/{id}/activate', 
[App\Http\Controllers\AdminController::class, 'activate_professionnels'])
->name('activate-professionnels');

Route::get('professionnels/{id}/deactivate', 
[App\Http\Controllers\AdminController::class, 'deactivate_professionnels'])
->name('deactivate-professionnels');


Route::post('/add_users', 
[App\Http\Controllers\AdminController::class, 'add_users'])
->name('add_users');

Route::get('clients/{id}/delete', 
[App\Http\Controllers\AdminController::class, 'deleteClient'])
->name('delete-client');


Route::get('/admin/avis', [App\Http\Controllers\AdminController::class, 'avis'])->name('avis');
Route::post('/avis', [App\Http\Controllers\AdminController::class, 'store'])->name('avis.store');

Route::get('admin.visiteur', 
[App\Http\Controllers\AdminController::class, 'visiteur'])
->name('visiteur');

/////////////////////////// * GENERATION DES FICHIES PDF * ///////////////////////

Route::get('/generer-pdf-employe', 
[App\Http\Controllers\PDFEmployeController::class, 'generePDFEmploye'])
->name('generePDFEmploye');

Route::get('/generer-pdf-avis', 
[App\Http\Controllers\PDFAvisController::class, 'generePDFEmploye'])
    ->name('generePDFAvis');

Route::get('/generer-pdf-clients', 
[App\Http\Controllers\PDFClientsController::class, 'generePDFClient'])
    ->name('generePDFClient');

Route::get('/generer-pdf-professionnels', 
[App\Http\Controllers\PDFProfessionnelsController::class, 'generePDFProfessionnel'])
    ->name('generePDFProfessionnel');

Route::get('/generer-pdf-suivi', 
[App\Http\Controllers\PDFSuiviController::class, 'generePDFSuivi'])
    ->name('nouveauNomPDFSuivi');


Route::get('/generer-pdf-suiviP', [
App\Http\Controllers\PDFSuiviPController::class, 'genereP_PDFSuivi'])
    ->name('genereP_PDFSuivi');


Route::get('/generer-pdf-audits', 
[App\Http\Controllers\PDFAuditController::class, 'generePDFAudit'])
    ->name('generePDFAudit');

Route::get('/generer-pdf-demandes', 
[App\Http\Controllers\PDFDemandeController::class, 'generePDFDemande'])
     ->name('generePDFDemande');

Route::get('/generer-pdf-notations', 
[App\Http\Controllers\PDFNotationController::class, 'generePDFNotation'])
    ->name('generePDFNotation');

     /////////////////////////// * GENERATION DES FICHIES PDF * ///////////////////////


     /////////////////////////////////////// *PROFESSIONNEL*//////////////////////////////////

Route::get('/login-professionnel', [App\Http\Controllers\Auth\ProfessionnelLoginController::class, 'showLoginForm'])->name('login-professionnel');

Route::post('professionnel/login', [ProfessionnelAuthController::class, 'login'])
->name('professionnel.login.submit');

Route::get('/inscription-professionnel', [ProfessionnelRegisterController::class, 'showRegistrationForm'])
    ->name('professionnel.register.form');

Route::post('/inscription-professionnel', [ProfessionnelRegisterController::class, 'register'])
    ->name('professionnel.register.submit');

Route::get('register-professionnel', [ProfessionnelRegisterController::class, 'showRegistrationForm'])->name('register-professionnel');
Route::post('/professionnel/register', [ProfessionnelRegisterController::class, 'register'])->name('professionnel.register.submit');
Route::get('professionnels', 
[App\Http\Controllers\ProfessionelController::class, 'professionnels'])
->name('professionnels');

Route::get('professionnel.changerMotPasseP', 
[App\Http\Controllers\ProfessionelController::class, 'changerMotPasseP'])
->name('changerMotPasseP');

Route::post('professionnel.updatePasswordP', 
[App\Http\Controllers\ProfessionelController::class, 'updatePasswordP'])
->name('updatePasswordP');

Route::get('professionnel.profilP', 
[App\Http\Controllers\ProfessionelController::class, 'profilP'])
->name('profilP');

Route::put('/update-profilP', [App\Http\Controllers\ProfessionelController::class, 'update_profilP'])
    ->name('update_profilP');

Route::get('professionnel.clientsP', 
[App\Http\Controllers\ProfessionelController::class, 'clientsP'])
->name('clientsP');

Route::get('professionnel.paiementP', 
[App\Http\Controllers\ProfessionelController::class, 'paiementP'])
->name('paiementP');

Route::get('professionnel.planifieP', 
[App\Http\Controllers\ProfessionelController::class, 'planifieP'])
->name('planifieP');

Route::get('professionnel.suiviP', 
[App\Http\Controllers\ProfessionelController::class, 'suiviP'])
->name('suiviP');

Route::delete('/supprimer-evenement/{id}', 
[App\Http\Controllers\ProfessionelController::class, 'supprimerEvenement'])
->name('supprimer_evenement');


// Route pour mettre à jour le statut du rendez-vous

// Rejeté
Route::get('rejeterRendezVous/{id}', [App\Http\Controllers\ProfessionelController::class, 'rejeterRendezVous'])
    ->name('rejeterRendezVous');

// Accepté
Route::get('accepterRendezVous/{id}', [App\Http\Controllers\ProfessionelController::class, 'accepterRendezVous'])
    ->name('accepterRendezVous');

// Annulé
Route::get('annulerRendezVous/{id}', [App\Http\Controllers\ProfessionelController::class, 'annulerRendezVous'])
    ->name('annulerRendezVous');
    
// Honoré
Route::get('honorerRendezVous/{id}', [App\Http\Controllers\ProfessionelController::class, 'honorerRendezVous'])
    ->name('honorerRendezVous');

Route::get('/generer-pdf-clients', 
[App\Http\Controllers\PDFClientsPController::class, 'genereP_PDFClient'])
    ->name('genereP_PDFClient');

Route::get('/generer-pdf-suivi', 
[App\Http\Controllers\PDFSuiviPController::class, 'genereP_PDFSuivi'])
    ->name('genereP_PDFSuivi');

// Clendrier 
Route::post('/sauvegarder-emploi', 
[App\Http\Controllers\ProfessionelController::class, 'sauvegarderEmploi'])
->name('emploi.sauvegarder');

//************************************ CLIENTS************************************* */

Route::get('/visiteur/login', [VisiteurAuthController::class, 'showLoginForm']);

Route::post('/visiteur/register', [VisiteurRegisterController::class, 'register'])->name('visiteur.register.submit');

Route::get('register-visiteur', [App\Http\Controllers\Auth\VisiteurRegisterController::class, 'showRegistrationForm'])->name('register-visiteur');
Route::post('register-visiteur', [VisiteurRegisterController::class, 'register']);

Route::get('/login-visiteur', [App\Http\Controllers\Auth\VisiteurLoginController::class, 'showLoginForm'])->name('login-visiteur');
Route::post('visiteur/login', [VisiteurAuthController::class, 'login'])->name('visiteur.login.submit');


Route::match(['get', 'post'], 'recherche-professionel', [App\Http\Controllers\ClientsController::class, 'rechercher'])
    ->name('recherche');

Route::get('booking/{notaireId}', 
[App\Http\Controllers\ClientsController::class, 'booking'])
->name('booking');

Route::get('/detail/{notaireId}', 
[App\Http\Controllers\ClientsController::class, 'detail'])
->name('detail');

Route::post('/save-rdv', 
[App\Http\Controllers\ClientsController::class, 'saveRdv'])
->name('saveRdv');

Route::get('visiteur.RdvAccepte', 
[App\Http\Controllers\ClientsController::class, 'RdvAccepte'])
->name('RdvAccepte');

Route::get('visiteur.RdvClient', 
[App\Http\Controllers\ClientsController::class, 'RdvClient'])
->name('RdvClient');

Route::get('visiteur.RdvEnAttente', 
[App\Http\Controllers\ClientsController::class, 'RdvEnAttente'])
->name('RdvEnAttente');

Route::get('visiteur.Historique', 
[App\Http\Controllers\ClientsController::class, 'Historique'])
->name('Historique');

Route::get('visiteur.profilV', 
[App\Http\Controllers\ClientsController::class, 'profilV'])
->name('profilV');

Route::put('/update-profilV', [App\Http\Controllers\ClientsController::class, 'update_profilV'])
    ->name('update_profilV');



Route::get('visiteur.changerMotPasseV', 
[App\Http\Controllers\ClientsController::class, 'changerMotPasseV'])
->name('changerMotPasseV');

Route::post('admin.updatePasswordV', 
[App\Http\Controllers\ClientsController::class, 'updatePasswordV'])
->name('updatePasswordV');


//******************************AVIS DES CLIENTS******************************************* */

Route::get('/donner-note/{id}', [NoteController::class, 'create'])
->name('donner.note');

Route::post('/donner-note/{id}', [NoteController::class, 'store'])
->name('enregistrer.note');

Route::get('/confirmation', [NoteController::class, 'confirmation'])
->name('page.de.confirmation');

// REINITIALISE MOT DE PASSE 

Route::get('password/reset/{token}', 
[ResetPasswordController::class, 'showResetForm'])
->name('password.reset');

Route::post('password/reset', 
[ResetPasswordController::class, 'reset'])
->name('password.update');

Route::get('password/resets_visiteurs', 
[ResetPasswordController::class, 'showVisitorResetForm'])
->name('password.reset.visiteur');

Route::post('password/send-reset-link', 
[ResetPasswordController::class, 'sendResetLinkEmail'])
->name('password.sendResetLinkEmail');


Route::get('password/resets_professionnels', 
[ResetProfessionnelPasswordController::class, 'showVisitorResetForm'])
->name('password.reset.professionnel');

Route::post('password/send-reset-link-professionnel', 
[ResetProfessionnelPasswordController::class, 'sendResetLinkEmailProfessionnel'])
->name('password.sendResetLinkEmailProfessionnel');


