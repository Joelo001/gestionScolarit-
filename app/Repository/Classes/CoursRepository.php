<?php

namespace App\Repository\Classes;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Enseignant;
use App\Models\Cours;
use App\Repository\Interface\CoursRepositoryInterface;
use App\Exceptions\CoursException;

class CoursRepository implements CoursRepositoryInterface
{
    /**
     * Ajouter un cours.
     *
     * @param Cours $cours
     * @param int $enseignantId
     * @return Cours $cours
     * @throws CoursException
     */
    public function AddCourse(Cours $cours, $enseignantId): Cours
    {
        try {
            DB::beginTransaction();

            // Association de l'enseignant
            $cours->enseignant_id = $enseignantId;

            // Sauvegarde
            $cours->saveOrFail();

            DB::commit();
            return  $cours;
        } catch (Exception $e) {
            DB::rollBack();
            throw new CoursException("Erreur lors de l'ajout du cours : " . $e->getMessage());
        }
    }

    /**
     * Mettre à jour un cours.
     *
     * @param array $coursData
     * @param int $id
     * @return Cours $cours
     * @throws CoursException
     */
    public function UpdateCourse(array $coursData, $id): Cours
    {
        try {
            DB::beginTransaction();

            // Vérification si le cours existe
            $coursexist = Cours::where("id","=",$id)->first();
            if (empty($coursexist)) {
                throw new CoursException("le cours cherché n'existe pas !");
            }

            $filteredData = array_filter($coursData, fn($value) => !is_null($value));

            // Mise à jour
            $coursexist->update($filteredData);

            DB::commit();
            return $coursexist;
        } catch (Exception $e) {
            DB::rollBack();
            throw new CoursException("Erreur lors de la mise à jour du cours : " . $e->getMessage());
        }
    }

 /**
 * L'enseignant donnant un cours.
 *
 * @param int $coursid
 * @return mixed
 * @throws CoursException
 */
    public function getCourse($coursid)
    {
        try {
            // Vérification si le cours existe
            $coursexist = Cours::find($coursid);
            if (!$coursexist) {
                throw new CoursException("Le cours cherché n'existe pas !");
            }

            // L'enseignant donnant le cours
            $enseignant = $coursexist->enseignant;

            if (!$enseignant) {
                throw new Exception("Ce cours n'a  pas d'enseignant affecté !");
            }

            return $enseignant;
        } catch (Exception $e) {
            throw new CoursException("Erreur lors de la récupération de l'enseignants : " . $e->getMessage());
        }
    }


     /**
 * L'enseignant donnant un cours.
 *
 * @param int $coursid
 * @return mixed
 * @throws CoursException
 */
    public function getSalles($coursid)
    {
        try {
            // Vérification si le cours existe
            $coursexist = Cours::find($coursid);
            if (!$coursexist) {
                throw new CoursException("Le cours cherché n'existe pas !");
            }

            // L'enseignant donnant le cours
            $listeSalles = $coursexist->salles;

            if ($listeSalles->isEmpty()) {
                throw new Exception("Ce cours n'a  pas de salles affectées !");
            }

            return $listeSalles;
        } catch (Exception $e) {
            throw new CoursException("Erreur lors de la récupération de salles : " . $e->getMessage());
        }
    }


    /**
     * Supprimer un cours.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws CoursException
     */
    public function DeleteCourse( $id)
    {
        try {
            DB::beginTransaction();

            // Vérification si le cours existe
            $cours = Cours::where("id","=",$id)->first();
            if (!$cours) {
                throw new CoursException("le cours cherché n'existe pas !");
            }

            // Suppression
            $cours->delete();

            DB::commit();
            return ;
        } catch (Exception $e) {
            DB::rollBack();
            throw new CoursException("Erreur lors de la suppression du cours : " . $e->getMessage());
        }
    }
}
