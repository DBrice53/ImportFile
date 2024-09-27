<?php

namespace App\Http\Controllers;

use App\Imports\ImportFiles;
use App\Models\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importation de la façade DB pour les transactions
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class ImportController extends Controller
{
    // Affiche la page d'importation avec les données importées
    public function index()
    {
        // Récupérer toutes les données de la table "imports"
        $importedData = Import::all();

        // Passer les données récupérées à la vue "Import"
        return view('Import', ['imports' => $importedData]);
    }

    // Gère l'importation de fichiers Excel avec transaction atomique
    public function import(Request $request)
    {
        // Validation du fichier téléchargé
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv|max:2048',
        ]);

        // Début de la transaction
        DB::beginTransaction();

        try {
            // Importation du fichier Excel
            Excel::import(new ImportFiles, $request->file('file'));

            // Confirme la transaction si tout est correct
            DB::commit();

            // Redirection avec un message de succès
            return Redirect::back()->with('success', 'Fichier importé avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, annule la transaction
            DB::rollBack();

            // Redirection avec un message d'erreur
            return Redirect::back()->with('error', 'Une erreur est survenue lors de l\'importation du fichier.');
        }
    }
}
