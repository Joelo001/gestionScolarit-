<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploieTemps;
use App\Service\EmploiTempsService;

use Symfony\Illuminate\Validation\ValidationException;
use Exception;

class EmploiTempsController extends Controller
{
    // Déclaration du service EmploiTempsService pour gérer la logique métier
    private $emploiTempsService;

    // Le constructeur injecte le service EmploiTempsService dans le contrôleur
    public function __construct(EmploiTempsService $emploiTempsService)
    {
        $this->emploiTempsService = $emploiTempsService;
    }

    /**
     * Créer un emploi du temps.
     * Cette méthode valide les données de la requête et crée un nouvel emploi du temps dans la base de données.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données de la requête
            $validatedData = $request->validate([
                'enseignant_id' => 'required|integer',
                'cours_id' => 'required|integer',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i:s|after:start_time',// Vérifie que la fin est après le début
                'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'
            ]);

            // Assignation des données validées à des variables
            $enseignant_id = $validatedData['enseignant_id'];
            $course_id = $validatedData['cours_id'];

            // Création de l'objet EmploiTemps
            $emploieTemps = new EmploieTemps();
            $emploieTemps->start_time = $validatedData['start_time'];
            $emploieTemps->end_time = $validatedData['end_time'];
            $emploieTemps->day_of_week = $validatedData['day_of_week'];

            // Appel du service pour ajouter l'emploi du temps dans la base de données
            $emploieTempsSave = $this->emploiTempsService->ajouterEmploiDeTemps($emploieTemps, $course_id, $enseignant_id);

            // Réponse JSON indiquant le succès de l'opération
            return response()->json([
                'status' => 201,
                'message' => 'Emploi du temps créé avec succès.',
                'data' => $emploieTempsSave
            ], 201);
        }catch (ValidationException $e) {
            // Gestion des erreurs de validation
            return response()->json([
                'message' => 'Erreur de validation.',
                'errors' => $e->errors()
            ], 422);
        }
        catch (Exception $e) {
            // En cas d'erreur, renvoie une réponse JSON d'erreur
            return response()->json([
                'status' => 500,
                'message' => "Une erreur s'est produite lors de la création de l'emploi du temps : " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Afficher un emploi du temps spécifique.
     * Cette méthode récupère un emploi du temps spécifique à l'aide de l'ID.
     */
    public function show($id)
    {
        try {
            // Appel du service pour récupérer l'emploi du temps avec l'ID spécifié
            $emploieTemps = $this->emploiTempsService->afficherEmploi($id);

            // Réponse JSON avec l'emploi du temps trouvé
            return response()->json([
                'status' => 200,
                'message' => 'Emploi du temps récupéré avec succès.',
                'data' => $emploieTemps
            ], 200);
        } catch (Exception $e) {
            // En cas d'erreur, renvoie une réponse JSON avec message d'erreur
            return response()->json([
                'status' => 404,
                'message' => "Emploi du temps non trouvé : " . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Afficher un emploi du temps pour un cours spécifique.
     */
    public function showCours($id)
    {
        try {
            $emploieTempscours = $this->emploiTempsService->afficherCours($id);

            return response()->json([
                'status' => 200,
                'message' => 'Cours récupéré.',
                'data' => $emploieTempscours
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => "Emploi du temps non trouvé : " . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Afficher un emploi du temps pour un enseignant spécifique.
     */
    public function showTeacher($id)
    {
        try {
            $emploieTempsTeacher = $this->emploiTempsService->afficherTeacher($id);

            return response()->json([
                'status' => 200,
                'message' => 'enseignant récupéré !!',
                'data' => $emploieTempsTeacher
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => "Emploi du temps non trouvé : " . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Mettre à jour un emploi du temps spécifique.
     * Cette méthode permet de mettre à jour les informations d'un emploi du temps existant.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validation des données de la requête pour la mise à jour
            $validatedData = $request->validate([
                'enseignant_id' => 'required|integer',
                'cours_id' => 'required|integer',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i:s|after:start_time',// Vérifie que la fin est après le début
                'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'
            ]);

            // Mise à jour de l'emploi du temps via le service
            $emploieTempsUpdate = $this->emploiTempsService->ModifierEmploiTemps($validatedData, $id);

            return response()->json([
                'status' => 200,
                'message' => 'Emploi du temps mis à jour avec succès.',
                'data' => $emploieTempsUpdate
            ], 200);
        }catch (ValidationException $e) {
            // Gestion des erreurs de validation
            return response()->json([
                'status' => 422,
                'message' => 'Erreur de validation.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Une erreur s'est produite lors de la mise à jour de l'emploi du temps : " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Supprimer un emploi du temps spécifique.
     * Cette méthode permet de supprimer un emploi du temps existant.
     */
    public function destroy($id)
    {
        try {
            // Appel du service pour supprimer l'emploi du temps
            $this->emploiTempsService->supprimerEmploiTemp($id);

            return response()->json([
                'status' => 200,
                'message' => 'Emploi du temps supprimé avec succès.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Une erreur s'est produite lors de la suppression de l'emploi du temps : " . $e->getMessage()
            ], 500);
        }
    }
}
