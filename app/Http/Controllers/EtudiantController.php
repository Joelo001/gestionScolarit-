<?php
namespace App\Http\Controllers;
use App\Models\Etudiant;
use App\Models\Parents;
use App\Service\EtudiantService;
use App\Exceptions\ParentsException;
use App\Exceptions\EtudiantException;
use App\Http\Requests\EtudiantEditRequest;
use App\Http\Requests\EtudiantRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class EtudiantController extends Controller
{
    protected $etudiantService;

    public function __construct(EtudiantService $etudiantService)
    {
        $this->etudiantService = $etudiantService;
    }

    public function saveStudent(EtudiantRequest $request)
    {
    
        try {
            // Validation des données
            $validatedData = $request->validated();

            // Création des objets Etudiant et Parents
            $etudiant = new Etudiant($validatedData['etudiant']);
            $parents = new Parents($validatedData['parents']);

            // Enregistrement des données via le service
            $this->etudiantService->saveStudent($etudiant, $parents);

            // Réponse JSON avec succès
            return response()->json(['message' => 'Étudiant enregistré avec succès'], 201);
        } catch (ParentsException $e) {
            Log::error("Erreur lors de la création du parent : " . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création du parent'], 500);
        } catch (EtudiantException $e) {
            Log::error("Erreur lors de la création de l'étudiant : " . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création de l\'étudiant'], 500);
        } catch (Exception $e) {
            Log::error("Erreur inconnue survenue : " . $e->getMessage());
            return response()->json(['error' => "Erreur inconnue survenue"], 500);
        }
    }
    public function findAll(){
        try{
                $students =$this->etudiantService->getStudents();
                return response()->json($students,200);
        }catch(EtudiantException $e){
            $this->msg("Erreur inconnue survenue : ",$e);
            return response()->json(['error' => "Erreur inconnue survenue"], 500);
        }

        
    }
    public function updateStudent(EtudiantEditRequest $etudiantRequest,$id){
        try{
            $datavalidate = $etudiantRequest->validated();
            $updateStudent =new Etudiant($datavalidate);
            $this->etudiantService->updateStudent($updateStudent,$id);
            return response()->json($updateStudent,200);
        }catch(EtudiantException $e){
            $this->msg("Erreur inconnue survenue : ",$e);
            return response()->json(['error' => "Erreur inconnue survenue".$e], 500);

        }
    }

public function findStudentByEmail(string $email)
{
    try {
        $student = $this->etudiantService->getStudentByEmail($email);

        if (!$student) {
            return response()->json(['error' => 'Aucun étudiant trouvé avec cet email.'], 404);
        }

        return response()->json($student, 200);
    } catch (EtudiantException $e) {
        Log::error("Erreur lors de la recherche de l'étudiant : " . $e->getMessage());
        return response()->json(['error' => "Erreur lors de la recherche de l'étudiant"], 500);
    }
}
    public function deleteStudent(Etudiant $etudiant){
        try{
           if(Etudiant::find($etudiant->id)){ $this->etudiantService->deleteStudent($etudiant);
            return response()->json([
                'message'=>'etudiant supprimer avec succes'
            ],200);
        }else{
            return response()->json([
                'message'=>'etudiant non trouver'
            ],404);
        }
           
        }catch(EtudiantException $e){
            $this->msg("Erreur inconnue survenue : ",$e);
            return response()->json(['error' => "Erreur inconnue survenue"], 500);
        }
    }
    public function msg($msg,$e){
        Log::error($msg.$e->getMessage());
    }
}
