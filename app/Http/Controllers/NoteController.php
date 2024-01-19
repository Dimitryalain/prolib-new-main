<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RDV; // Assurez-vous d'importer le modèle RDV

class NoteController extends Controller
{
    public function create($id)
    {
        $rendezvous = RDV::findOrFail($id);
        return view('donner_note', compact('rendezvous'));
    }

    public function store(Request $request, $id)
    {
        $rendezvous = RDV::findOrFail($id);

        // Validez les données envoyées par le formulaire
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:255',
        ]);

        // Enregistrez la note et le commentaire dans la base de données
        $rendezvous->note = $request->input('note');
        $rendezvous->commentaire = $request->input('commentaire');
        $rendezvous->save();

        return redirect()->route('page.de.confirmation')->with('success', 'Note et commentaire enregistrés avec succès');
    }

    public function confirmation()
    {
        return view('confirmation');
    }

}
