<?php
namespace App\Repository\Interface;
use App\Models\Enseignant;
use App\Models\Cours;
use App\Models\EmploieTemps;

interface EmploiTempsRepositoryInterface{
    public function AddEmploiTemps(EmploieTemps $emploieTemps,$coursid, $enseignantid);
    public function UpdateEmploiTemps(array $emploieTemps,$id);
    public function DeleteEmploiTemps($id);
}
