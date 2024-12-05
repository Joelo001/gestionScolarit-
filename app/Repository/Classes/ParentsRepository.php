<?php

namespace App\Repository\Classes;

use App\Exceptions\ParentsException;
use App\Models\Parents;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Repository\Interface\ParentsRepositoryInterface;

class ParentsRepository implements ParentsRepositoryInterface
{
    /**
     * Ajouter un parent dans la base de données.
     *
     * @param Parents $parents
     * @return Parents
     * @throws ParentsException
     */
    public function addParents(Parents $parents)
    {
        try {
            DB::beginTransaction();

            $parents->save();

            DB::commit();
            return $parents;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage("Erreur lors de l'ajout du parent !", $e);
            throw new ParentsException("Erreur lors  d'ajouter du parent.{$e}");

        }
    }

    /**
     * Récupérer tous les parents.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ParentsException
     */
    public function findAllParents()
    {
        try {
            return Parents::all();
        } catch (\Exception $e) {
            $this->errorMessage("Erreur lors de la récupération des parents !", $e);
            throw new ParentsException("Erreur lors de la récupération des parents !");

        }
    }

    /**
     * Trouver un parent par email.
     *
     * @param string $email
     * @return Parents|null
     * @throws ParentsException
     */
    public function findParentsByEmail(string $email): ?Parents
    {
        try {
            return Parents::where("addresse", $email)->first();
        } catch (\Exception $e) {
            $this->errorMessage("Erreur lors de la recherche du parent !", $e);
            throw new ParentsException("Erreur lors de la recherche du  parents !");

        }
    }

    /**
     * Mettre à jour les informations d'un parent.
     *
     * @param Parents $parents
     * @return bool
     * @throws ParentsException
     */
    public function updateParents(Parents $parents): bool
    {
        try {
            DB::beginTransaction();

            $updated = $parents->update();

            DB::commit();
            return $updated;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage("Erreur lors de la mise à jour du parent !", $e);
            throw new ParentsException("Erreur lors de la mise à jour du parent !");

        }


    }

    /**
     * Supprimer un parent.
     *
     * @param Parents $parents
     * @return bool
     * @throws ParentsException
     */
    public function deleteParents(Parents $parents): bool
    {
        try {
            DB::beginTransaction();

            $deleted = $parents->delete();

            DB::commit();
            return $deleted;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage("Erreur lors de la suppression du parent !", $e);
            throw new ParentsException("Erreur lors de la suppression du parent !");

        }

    }

    /**
     * Gérer les erreurs en les loggant et en lançant une exception.
     *
     * @param string $message
     * @param \Exception $error
     * @throws ParentsException
     */
    private function errorMessage(string $message, \Exception $error)
    {
        Log::error($message . " " . $error->getMessage());
        throw new ParentsException($message);
    }
}
