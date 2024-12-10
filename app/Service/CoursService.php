<?php
namespace App\Service;

use Exception;
use App\Exceptions\CoursException;

use App\Repository\Classes\CoursRepository;
use App\Models\Cours;
use App\Models\Enseignant;


class CoursService
{
    private $coursRepositoy;
    public function __construct(CoursRepository $coursRepositoy){
        $this->coursRepository=$coursRepositoy;
    }

    public function ajouterCours(Cours $cours, $idenseignant):Cours{
        try {
            $enseignant=Enseignant::find($idenseignant);
            if (empty($enseignant)) {
                return throw new  Exception("L'enseignant specifier n'a pas été trouvé veillez l'enregistrer de nouveau !");
            }
            return $this->coursRepository->AddCourse($cours, $idenseignant);
        } catch (Exception $th) {
            throw new CoursException("{$th->getMessage()}");
        }
    }

    public function ModifierCours(array $cours, $idCoures):Cours{
        try {

            if (!empty($cours["enseignant_id"])) {
                $enseignant=Enseignant::where("id","=",$cours["enseignant_id"])->first();
                if(!$enseignant){
                    throw new exception("Enseignat introuvable");
                }
            }
            return $this->coursRepository->UpdateCourse($cours, $idCoures);
        } catch (Exception $th) {
            throw new CoursException(" {$th->getMessage()}");
        }
    }

    public function getTeacher($idcours){
        try {
            return $this->coursRepository->getCourse($idcours);
        } catch (Exception $th) {
            throw new Exception("{$th->getMessage()}");
        }
    }

    public function getClasses($idcours){
        try {
            return $this->coursRepository->getSalles($idcours);
        } catch (Exception $th) {
            throw new Exception("{$th->getMessage()}");
        }
    }

    public function supprimerCours( $idcours){
        try {
            $this->coursRepository->DeleteCourse($idcours);
            return response()->json(["statut"=>200, "message"=>'suppression reussie !'],200);
        } catch (Exception $th) {
            throw new CoursException("{$th->getMessage()}");
        }
    }
}
