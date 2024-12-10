<?php
namespace App\Repository\Interface;
use App\Models\Enseignant;
use App\Models\Cours;
interface CoursRepositoryInterface{
    public function AddCourse(Cours $cours ,Enseignant $enseignant );
    public function UpdateCourse(array $cours ,$id);
    public function DeleteCourse(Cours $cours );
}
