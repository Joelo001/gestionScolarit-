<?php
namespace App\Repository\Interface;

use App\Models\Etudiant;
use App\Models\Parents;

Interface EtudiantRepositoryInterface{
    public function addStudent(Etudiant $etudiant,Parents $parents);
    public function findAllStudent();
    public function findStudentByEmail(string $email);
    public function updateStudent(Etudiant $etudiant,$îd);
    public function deleteStudent(Etudiant $etudiant);
}