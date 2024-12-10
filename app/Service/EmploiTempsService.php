<?php

namespace App\Service;

use Exception;
use App\Exceptions\CoursException;
use App\Repository\Classes\EmploiTempsRepository;
use App\Models\Cours;
use App\Models\Enseignant;
use App\Models\EmploieTemps;

class EmploiTempsService
{
    private $emploiTempsRepository;

    public function __construct(EmploiTempsRepository $emploiTempsRepository)
    {
        $this->emploiTempsRepository = $emploiTempsRepository;
    }

    /**
     * Ajouter un emploi du temps.
     *
     * @param EmploieTemps $emploieTemps
     * @param int $idcours
     * @param int $idenseignant
     * @return EmploieTemps
     * @throws Exception
     */
    public function ajouterEmploiDeTemps(EmploieTemps $emploieTemps, $idcours, $idenseignant): EmploieTemps
    {
        try {
            $enseignant = Enseignant::find($idenseignant);
            $cours = Cours::find($idcours);

            if (!$enseignant) {
                throw new Exception("L'enseignant spécifié n'a pas été trouvé. Veuillez l'enregistrer de nouveau !");
            }
            if (empty($cours)) {
                throw new Exception("Le cours spécifié n'a pas été trouvé. Veuillez l'enregistrer de nouveau !");
            }

            return $this->emploiTempsRepository->AddEmploiTemps($emploieTemps, $idcours, $idenseignant);
        } catch (Exception $th) {
            throw new Exception("{$th->getMessage()}");
        }
    }

    /**
     * Modifier un emploi du temps.
     *
     * @param array $emploieTemps
     * @param int $idemploidetemps
     * @return EmploieTemps
     * @throws CoursException
     */
    public function ModifierEmploiTemps(array $emploieTemps, int $idemploidetemps): EmploieTemps
    {
        try {
            $enseignant = Enseignant::find($emploieTemps["enseignant_id"]);
            $cours = Cours::find($emploieTemps["cours_id"]);

            if (empty($enseignant)) {
                throw new Exception("L'enseignant spécifié n'a pas été trouvé. Veuillez l'enregistrer de nouveau !");
            }
            if (empty($cours)) {
                throw new CoursException("Le cours spécifié n'a pas été trouvé. Veuillez l'enregistrer de nouveau !");
            }

            return $this->emploiTempsRepository->UpdateEmploiTemps($emploieTemps, $idemploidetemps);
        } catch (Exception $th) {
            throw new Exception("{$th->getMessage()}");
        }
    }

    /**
     * Supprimer un emploi du temps.
     *
     * @param int $idemploidetemps
     * @throws CoursException
     */
    public function supprimerEmploiTemp(int $idemploidetemps): void
    {
        try {
            $this->emploiTempsRepository->DeleteCourse($idemploidetemps);
        } catch (Exception $th) {
            throw new CoursException("Une erreur s'est produite : {$th->getMessage()}");
        }
    }

    /**
     * Récupérer le cours associé à un emploi du temps.
     *
     * @param int $idemploidetemps
     * @return Cours
     * @throws CoursException
     */
    public function afficherCours(int $idemploidetemps): Cours
    {
        try {
            return $this->emploiTempsRepository->getEmploiTempsCours($idemploidetemps);
        } catch (Exception $th) {
            throw new CoursException(" {$th->getMessage()}");
        }
    }

    /**
     * Récupérer l'enseignant associé à un emploi du temps.
     *
     * @param int $idemploidetemps
     * @return Enseignant
     * @throws CoursException
     */
    public function afficherTeacher(int $idemploidetemps): Enseignant
    {
        try {
            return $this->emploiTempsRepository->getEmploiTempsTeacher($idemploidetemps);
        } catch (Exception $th) {
            throw new CoursException("Une erreur s'est produite : {$th->getMessage()}");
        }
    }

    /**
     * Récupérer un emploi du temps.
     *
     * @param int $idemploidetemps
     * @return EmploieTemps
     * @throws CoursException
     */
    public function afficherEmploi(int $idemploidetemps): EmploieTemps
    {
        try {
            return $this->emploiTempsRepository->getEmploiTemps($idemploidetemps);
        } catch (Exception $th) {
            throw new CoursException("Une erreur s'est produite : {$th->getMessage()}");
        }
    }
}
