<?php
namespace App\Repository\Interface;

use App\Models\Parents;

Interface ParentsRepositoryInterface {

    public function addParents(Parents $parents);
    public function findAllParents();
    public function findParentsByEmail(string $email);
    public function updateParents(Parents $parents);
    public function deleteParents(Parents $parents);
}