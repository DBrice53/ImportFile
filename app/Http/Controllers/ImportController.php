<?php

namespace App\Http\Controllers;

use App\Imports\ImportFiles;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class ImportController extends Controller
{
    public function index(){
        return view('Import'); // Assurez-vous que cette vue est correctement configurée
    }

    public function import(Request $request){
        // Validation du fichier
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv|max:2048',
        ]);

        try {
            // Importation du fichier
            Excel::import(new ImportFiles, $request->file('file'));

          

            // Redirection avec message de succès
            return Redirect::back()->with('success', 'Fichier importé avec succès.');
        } catch (\Exception $e) {
            // Redirection avec message d'erreur en cas d'exception
            return Redirect::back()->with('error', 'Une erreur est survenue lors de l\'importation du fichier.');
        }
    }
}
