<?php
namespace App\Service;

use Exception;
use App\Models\Parents;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ParentsException;
use App\Repository\Interface\ParentsRepositoryInterface;

class ParentService{
    private ParentsRepositoryInterface $parentsRepository;
    public function __construct(ParentsRepositoryInterface $parentsRepository){
        $this->parentsRepository =$parentsRepository;
    }
    
    public function createParent(Parents $parents){
        try{
            return $this->parentsRepository->addParents($parents);
        }catch(ParentsException $e){
            Log::error("erreur lors de la création du parent !".$e->getMessage());
            throw new ParentsException("erreur lors de l'ajout du parent à la base de données !");
        }catch(Exception $e){

            Log::error("erreur inconu survenue lors de la création du parent !".$e->getMessage());
            throw new Exception("erreur inconu survenue lors de la création du parent !!");
        }
    }
    public function getParents(){
        try{
           return $this->parentsRepository->findAllParents();
        }catch(ParentsException $e){
            Log::error("erreur lors de la recherche des parents !".$e->getMessage());
            throw new Exception("erreur lors de la recherche des parentss !");
        }catch(Exception $e){

            Log::error("erreur inconu survenue lors recherche des parents !".$e->getMessage());
            throw new Exception("erreur inconu survenue lors de la recherche des parents !");
        }
    }
    public function getParentByEmail(string $email){
        try{
            return $this->parentsRepository->findParentsByEmail($email);
        }catch(ParentsException $e){
            Log::error("erreur lors de la recherche du parent par son Email !".$e->getMessage());
            throw new ParentsException("erreur lors de la recherche du parent par son Email !");
        }catch(Exception $e){

            Log::error("erreur inconu survenue lors recherche du parent par son Email !".$e->getMessage());
            throw new Exception("erreur inconu survenue lors de la recherche du parent par son Email !");
        }
    }
    public function updateParent(Parents $parents){
        try{
            return $this->parentsRepository->updateParents($parents);
        }catch(ParentsException $e){
            Log::error("erreur lors de la mise a jour des information du parent !".$e->getMessage());
            throw new ParentsException("erreur lors mise a jour des information du parent !");
        }catch(Exception $e){

            Log::error("erreur inconu survenue lors mise a jour des information du parent !".$e->getMessage());
            throw new Exception("erreur inconu survenue lors mise a jour des information du parent  !");
        }
    }
    public function deleteParent(Parents $parents){
        try{
            return $this->parentsRepository->deleteParents($parents);
        }catch(ParentsException $e){
            Log::error("erreur lors de la suppression des information du parent !".$e->getMessage());
            throw new ParentsException("erreur lors suppression des information du parent !");
        }catch(Exception $e){

            Log::error("erreur inconu survenue lors suppression des information du parent !".$e->getMessage());
            throw new Exception("erreur inconu survenue lors suppression des information du parent  !");
        }
    }
}