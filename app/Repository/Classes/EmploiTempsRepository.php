<?php

namespace App\Repository\Classes;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\EmploieTemps;
use App\Repository\Interface\EmploiTempsRepositoryInterface;
use App\Exceptions\EmploieTempsException;

class EmploiTempsRepository implements EmploiTempsRepositoryInterface
{
    /**
     * Ajouter un emploi du temps.
     *
     * @param EmploieTemps $emploieTemps
     * @param int $coursid
     * @param int $enseignantid
     * @return EmploieTemps $emploieTemps
     * @throws EmploieTempsException
     */
    public function AddEmploiTemps(EmploieTemps $emploieTemps, $coursid, $enseignantid)
    {
        try {
            DB::beginTransaction();


            $emploieTemps->enseignant_id = $enseignantid;
            $emploieTemps->course_id = $coursid;

            $emploieTemps->saveOrFail();

            DB::commit();
            return  $emploieTemps;
        } catch (Exception $e) {
            DB::rollBack();
            throw new EmploieTempsException("Erreur lors de l'ajout de l'emploi du temps : " . $e->getMessage());
        }
    }

    /**
     * Mettre à jour un emploi du temps.
     *
     * @param array $emploieTempsData
     * @param int $id
     * @return EmploieTemps $emploieTemps
     * @throws EmploieTempsException
     */
    public function UpdateEmploiTemps(array $emploieTempsData, $id)
    {
        try {
            DB::beginTransaction();

            $emploieTemps = EmploieTemps::find($id);
            if (!$emploieTemps) {
                throw new EmploieTempsException("Emploi du temps non trouvé.");
            }
            $filteredData = array_filter($emploieTempsData, fn($value) => !is_null($value));

            $emploieTemps->update($filteredData);

            DB::commit();
            return $emploieTemps;
        } catch (Exception $e) {
            DB::rollBack();
            throw new EmploieTempsException("Erreur lors de la mise à jour de l'emploi du temps : " . $e->getMessage());
        }
    }

    /**
     * Supprimer un emploi du temps.
     *
     * @param int $id
     * @return null
     * @throws EmploieTempsException
     */
    public function DeleteEmploiTemps( $id)
    {
        try {
            DB::beginTransaction();

            $emploieTemps = EmploieTemps::find($id);
            if (!$emploieTemps) {
                throw new EmploieTempsException("Emploi du temps non trouvé.");
            }


            $emploieTemps->delete();

            DB::commit();
            return ;
        } catch (Exception $e) {
            DB::rollBack();
            throw new EmploieTempsException("Erreur lors de la suppression de l'emploi du temps : " . $e->getMessage());
        }
    }

    /**
     * Récupérer l'enseignant associé à un emploi du temps.
     *
     * @param int $id
     * @return Enseignant|null
     * @throws EmploieTempsException
     */
    public function getEmploiTempsTeacher(int $id)
    {
        try {
            // Récupération de l'emploi du temps
            $emploieTemps = EmploieTemps::find($id);
            if (!$emploieTemps) {
                throw new EmploieTempsException("Emploi du temps non trouvé.");
            }

            // Récupération de l'enseignant associé
            $teacher = $emploieTemps->enseignant;

            if (!$teacher) {
                throw new EmploieTempsException("Emploi du temps non alloué à un enseignant.");
            }

            return $teacher;
        } catch (Exception $e) {
            // Gestion des exceptions génériques
            throw new EmploieTempsException("Erreur lors de la récupération de l'enseignant : " . $e->getMessage());
        }
    }


   /**
     * Récupérer le cours associés à un emploi du temps.
     *
     * @param int $id
     * @return Cours|null
     * @throws EmploieTempsException
     */
    public function getEmploiTempsCours(int $id)
    {
        try {
            // Récupération de l'emploi du temps
            $emploieTemps = EmploieTemps::find($id);
            if (!$emploieTemps) {
                throw new EmploieTempsException();
            }

            // Récupération des cours associés
            $cours = $emploieTemps->course; // recupère le cours associer a cette emploi de temps
            if (!$cours) {
                throw new EmploieTempsException("Aucun cours associé à cet emploi du temps.");
            }

            return $cours;
        } catch (Exception $e) {
            // Gestion des exceptions génériques
            throw new EmploieTempsException("Erreur lors de la récupération des cours" . $e->getMessage());
        }
    }

    /**
     * Récupérer un emploi du temps.
     *
     * @param int $id
     * @return EmploieTemps|null
     * @throws EmploieTempsException
     */
    public function getEmploiTemps(int $id)
    {
        try {
            // Récupération de l'emploi du temps
            $emploieTemps = EmploieTemps::find($id);
            if (!$emploieTemps) {
                throw new EmploieTempsException("Emploi du temps non trouvé.");
            }
            return $emploieTemps;
        } catch (Exception $e) {
            // Gestion des exceptions génériques
            throw new EmploieTempsException("Erreur lors de la récupération : " . $e->getMessage());
        }
    }
}
