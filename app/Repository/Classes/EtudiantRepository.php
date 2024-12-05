<?php
namespace App\Repository\Classes;

use Exception;
use App\Models\Parents;
use App\Models\Etudiant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\EtudiantException;
use App\Repository\Interface\EtudiantRepositoryInterface;

class EtudiantRepository implements EtudiantRepositoryInterface{
   
    public function addStudent(Etudiant $etudiant, Parents $parents): Etudiant
    {
        try {
            DB::beginTransaction();
    
            // Associe l'étudiant au parent
            $etudiant->parent_id = $parents->getAttribute("id");
            $etudiant->saveOrFail();
    
            DB::commit();
            return $etudiant; // Retourne l'étudiant créé avec succès
        } catch (Exception $exception) {
            DB::rollBack(); // Annule la transaction
            Log::error("Erreur lors de l'ajout de l'étudiant : " . $exception->getMessage());
    
            // Lève une exception personnalisée
            throw new EtudiantException("Erreur lors de l'ajout de l'étudiant.");
        }
    }
    public function findAllStudent(){
        try {
            DB::beginTransaction();
            $etudiants =Etudiant::all();
            DB::commit();
            return $etudiants; 
        } catch (Exception $exception) {
            DB::rollBack(); // Annule la transaction
            Log::error("Erreur lors de la recherche des étudiants : " . $exception->getMessage());
    
            // Lève une exception personnalisée
            throw new EtudiantException("Erreur lors de la recherche des étudiants");
        }

    }
    public function findStudentByEmail(string $email){
        try {
            DB::beginTransaction();
            $etudiant =Etudiant::where("adresse",$email)->first();
            DB::commit();
            return $etudiant; 
        } catch (Exception $exception) {
            DB::rollBack(); // Annule la transaction
            Log::error("Erreur lors de la recherche de l étudiants : " . $exception->getMessage());
    
            // Lève une exception personnalisée
            throw new EtudiantException("Erreur lors de la recherche de l étudiants");
        }
    }
    public function updateStudent(Etudiant $etudiant,$id){
        try {
            
            DB::beginTransaction();
            $etudiant_update= Etudiant::where('id','=',$id)
                                            ->update([
                                                'nom'=>$etudiant->nom,
                                                'prenom'=>$etudiant->prenom,
                                                'adresse'=>$etudiant->adresse,
                                                'num_tel'=>$etudiant->num_tel,
                                                'quartier'=>$etudiant->quartier,
                                                'niveau_academique'=>$etudiant->niveau_academique,
                                                'date_naissance'=>$etudiant->date_naissance,
                                                'serie'=>$etudiant->serie
                                            ]);
            DB::commit();
            return $etudiant_update; 
        } catch (Exception $exception) {
            DB::rollBack(); // Annule la transaction
            Log::error("Erreur lors de la recherche de la mise à jour de l' étudiant : " . $exception->getMessage());
    
            // Lève une exception personnalisée
            throw new EtudiantException("Erreur lors de la recherche de la mise à jour de l' étudiant ");
        }
    }
    public function deleteStudent(Etudiant $etudiant){
        try {
            DB::beginTransaction();
            $etudiant_delete = $etudiant->deleteOrFail();
            DB::commit();
            return $etudiant_delete; 
        } catch (Exception $exception) {
            DB::rollBack(); // Annule la transaction
            Log::error("Erreur lors de la  suppression de l' étudiant : " . $exception->getMessage());
    
            // Lève une exception personnalisée
            throw new EtudiantException("Erreur lors de la  suppression de l' étudiant");
        }
    }
}