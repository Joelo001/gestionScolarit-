<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Service\CoursService;
use App\Models\Cours;
use Symfony\Illuminate\Validation\ValidationException;
use Exception;

class CoursController extends Controller
{
    protected $CoursServices;
    public function __construct(CoursService $CoursServices){
        $this->CoursServices=$CoursServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'horaire' => 'required|string|max:255',
                'enseignant_id' => 'required|integer',
            ]);

            // Appel au service pour ajouter le cours
            $coursData = [
                'nom' => $validatedData['nom'],
                'description' => $validatedData['description'] ?? null,
                'horaire' => $validatedData['horaire'],
            ];

            $cours =new Cours($coursData);

            $enseignantId = $validatedData['enseignant_id'];

            $cours = $this->CoursServices->ajouterCours($cours ,$enseignantId);

            // Retour de la réponse en cas de succès
            return response()->json([
                'message' => 'Cours créé avec succès.',
                'cours' => $cours
            ], 201);
        } catch (ValidaValidationException $e) {
            // Gestion des erreurs de validation
            return response()->json([
                'message' => 'Erreur de validation.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            // Gestion des autres exceptions
            return response()->json([
                'message' => 'Une erreur est survenue.',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
       try {
        $teacher = $this->CoursServices->getTeacher($id );

        // Retour de la réponse en cas de succès
        return response()->json([
            'message' => 'Enseignant trouvé avec succès !!!',
            'enseignant' => $teacher
        ], 201);
       } catch (\Throwable $th) {
        return response()->json([
            'erreur' => 'Enseignant non trouvé !!!',
            'message' => $th->getmessage()
        ], 404);
       }
    }

    public function showClasses( $id)
    {
       try {
        $classes = $this->CoursServices->getClasses($id );

        // Retour de la réponse en cas de succès
        return response()->json([
            'message' => 'Salle(s) trouvé avec succès !!!',
            'salles' => $classes
        ], 201);
       } catch (\Throwable $th) {
        return response()->json([
            'erreur' => 'Salle(s) non trouvé !!!',
            'message' => $th->getmessage()
        ], 404);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {

            $validatedData=$request->validate([
                'nom' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'horaire' => 'nullable|string|max:255',
                'enseignant_id' => 'nullable|integer',
            ]);

             // Vérification qu'au moins une donnée est fournie
            if (empty(array_filter($validatedData))) {
                throw new Exception("Aucune donnée valide fournie pour la mise à jour.");
            }

            $coursData = [
                'nom' => $validatedData['nom']?? null,
                'description' => $validatedData['description'] ?? null,
                'horaire' => $validatedData['horaire']?? null,
            ];

             // Ajout de l'enseignant_id si présent
            if (!empty($validatedData['enseignant_id'])) {
                $coursData['enseignant_id'] = $validatedData['enseignant_id'];
            }

            // Appel au service de mise à jour
            $coursUpdate = $this->CoursServices->ModifierCours($coursData, $id);

            // Retour de la réponse en cas de succès
            return response()->json([
                'message' => 'Cours modifié avec succès.',
                'cours' => $coursUpdate
            ], 201);

        } catch (ValidaValidationException $e) {
            // Gestion des erreurs de validation
            return response()->json([
                'message' => 'Erreur de validation.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            // Gestion des autres exceptions
            return response()->json([
                'message' => 'Une erreur est survenue.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try {
        $this->CoursServices->supprimerCours($id);
        return response()->json(["statut"=>"Suppression reussie !! "],200);
      } catch (\Throwable $th) {
        return response()->json(["erreur"=>"Echec de la suppression !! ","message"=>$th->getMessage()],404);
      }
    }
}
