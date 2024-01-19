<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\RDV;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ProfessionnelAuthController extends Controller
{
    /**
     * Show the login form for notaires.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login-professionnel');
    }

    /**
     * Authenticate the notaire.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('adresse_email', 'password');
        $professionnel = Profession::where('adresse_email', $credentials['adresse_email'])->first();

        if ($professionnel && $professionnel->action) {
            if (Auth::guard('professionnel')->attempt($credentials, $request->remember)) {

                $year = date('Y');
                $profession_id = Auth::guard('professionnel')->user()->id;

                // Obtenir la moyenne des notes par rendez-vous pour ce professionnel
                $moyenneNotesParProfessionnel = RDV::select('profession_id', DB::raw('AVG(note) as moyenne_notes'))
                    ->whereYear("date_reservation", $year)
                    ->where("profession_id", $profession_id)
                    ->groupBy('profession_id')
                    ->first();

                $nombreVisiteursParProfessionnel = RDV::whereYear("date_reservation", $year)
                    ->where("profession_id", $profession_id)
                    ->count();

                $statusCounts = RDV::whereYear("date_reservation", $year)
                    ->where("profession_id", $profession_id)
                    ->groupBy('statut', 'profession_id')
                    ->select('profession_id', 'statut', DB::raw('count(*) as count'))
                    ->get();

                $currentYear = Carbon::now()->year;
                $rdvData = RDV::getRDVDataForYear($currentYear);
                $months = [];
                $counts = [];

                for ($month = 1; $month <= 12; $month++) {
                    $formattedMonth = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
                    $months[] = $formattedMonth;

                    $monthData = $rdvData->where('month', $formattedMonth)->first();

                    if ($monthData) {
                        $counts[] = $monthData->count;
                    } else {
                        $counts[] = 0;
                    }
                }

                $rdvDataForProfessional = RDV::getRDVDataForYearAndProfessionnel($currentYear, $profession_id);

                $monthsForProfessional = [];
                $countsForProfessional = [];

                for ($month = 1; $month <= 12; $month++) {
                    $formattedMonth = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
                    $monthsForProfessional[] = $formattedMonth;

                    $monthData = $rdvDataForProfessional->where('month', $formattedMonth)->first();

                    if ($monthData) {
                        $countsForProfessional[] = $monthData->count;
                    } else {
                        $countsForProfessional[] = 0;
                    }
                }

                $countRDVP = RDV::countRDVP();
                $countRDVenAttenteNotaire = RDV::countRDVenAttenteNotaire();
                $countRDVRejetNotaire = RDV::countRDVRejetNotaire();
                $countRDVValidNotaire = RDV::countRDVValidNotaire();
                $coubtRDVHonoreNotaire = RDV::coubtRDVHonoreNotaire();
                $countRDVAnnuleNotaire = RDV::countRDVAnnuleNotaire();
                $countRDVenAttenteNotaire = RDV::countRDVenAttenteNotaire();

                return view('professionnels', compact(
                    'professionnel',
                    'countRDVP',
                    'countRDVenAttenteNotaire',
                    'countRDVRejetNotaire',
                    'countRDVValidNotaire',
                    'coubtRDVHonoreNotaire',
                    'countRDVAnnuleNotaire',
                    'countRDVenAttenteNotaire',
                    'moyenneNotesParProfessionnel',
                    'nombreVisiteursParProfessionnel',
                    'statusCounts',
                    'months',
                    'counts',
                    'rdvData',
                    'monthsForProfessional',
                    'countsForProfessional'
                ));
            }
        } elseif ($professionnel && !$professionnel->action) {
            throw ValidationException::withMessages([
                'adresse_email' => __('Votre compte a été temporairement suspendu. Veuillez contacter l\'administrateur E-THIK +225 05 85 00 03 00'),
            ]);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'adresse_email' => __('Ces identifiants ne correspondent pas à nos enregistrements.'),
        ]);
    }

    /**
     * Log the notaire out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('professionnels')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
