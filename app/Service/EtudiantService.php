<?php
namespace App\Service;

use Exception;
use App\Models\Parents;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ParentsException;
use App\Exceptions\EtudiantException;
use App\Repository\Classes\EtudiantRepository;
use App\Repository\Interface\EtudiantRepositoryInterface;

class EtudiantService{
    private EtudiantRepositoryInterface $etudiantRepository;
    private ParentService $parentService;
    public function __construct(EtudiantRepositoryInterface $etudiantRepository,ParentService $parentService){
            $this->etudiantRepository = $etudiantRepository;
            $this->parentService = $parentService;

    }
    public function saveStudent(Etudiant $etudiant,Parents $parents){
        try{
            $find_parent =$this->parentService->getParentByEmail($parents->getAttribute("addresse"));
            if(empty($find_parent)){
                $find_parent =$this->parentService->createParent($parents);
            }
            return $this->etudiantRepository->addStudent($etudiant,$find_parent);
        }catch(ParentsException $e){
            Log::error("erreur lors de la création du parent !".$e->getMessage());
            throw new ParentsException("erreur lors de l'ajout du parent à la base de données !");

        }catch(EtudiantException $e){
            $this->errorMessage("creation de l 'etudiant",$e);
            throw new Exception("erreur  survenue lors de la création de l'etudiant! {$e->getMessage()}");

        }catch(Exception $e){
            Log::error("erreur inconnue survenue lors de la création de l'etudiant!".$e->getMessage());
            throw new Exception("erreur inconnue survenue lors de la création de l'etudiant! {$e->getMessage()}");
        }
        
    }
    public function updateStudent(Etudiant $etudiant,$id){
    try{
       
         return $this->etudiantRepository->updateStudent($etudiant,$id);
        
        }catch(EtudiantException $e){
            $this->errorMessage("erreur lors mise a jour  de l 'etudiant",$e);
            throw new EtudiantException("erreur lors mise a jour  de l 'etudiant");
        }catch(Exception $e){
            Log::error("erreur inconnue survenue lors de la mise a jour de l'etudiant!".$e->getMessage());
            throw new Exception("erreur inconnue survenue lors de la mise a jour de l'etudiant! !");
        }
    }
    public function getStudents(){
        try{
            return $this->etudiantRepository->findAllStudent();
        
        }catch(EtudiantException $e){
            $this->errorMessage("recherche des etudiants",$e);
        }catch(Exception $e){
            Log::error("erreur inconnue survenue lors de la recherche des etudiants !".$e->getMessage());
            throw new Exception("erreur inconnue survenue lors  de la recherche des etudiants !");
        }
    }
    
    public function getStudentByEmail(string $email){
        try{
            return $this->etudiantRepository->findStudentByEmail($email);
        
        }catch(EtudiantException $e){
            $this->errorMessage("recherche de l' etudiants",$e);
        }catch(Exception $e){
            Log::error("erreur inconnue survenue lors de la recherche de l' etudiants !".$e->getMessage());
            throw new Exception("erreur inconnue survenue lors  de la recherche de l' etudiants !");
        }
    }
    public function deleteStudent(Etudiant $etudiant){
        try{
            return $this->etudiantRepository->deleteStudent($etudiant);
        
        }catch(EtudiantException $e){
            $this->errorMessage("suppression de l' etudiants",$e);
        }catch(Exception $e){
            Log::error("erreur inconnue survenue lors de la suppression  de l' etudiants !".$e->getMessage());
            throw new Exception("erreur inconnue survenue lors  de la suppression de l' etudiants !");
        }
    }
    private function errorMessage(string $message,$e){
        Log::error("erreur lors de la  !".$message.$e->getMessage());
            throw new EtudiantException("erreur lors de la".$message);
    }
}