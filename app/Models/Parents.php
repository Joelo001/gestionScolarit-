<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'full_name',
        'addresse',
        'num_tel',
        'occupation'
    ];
   public function etudiants(){
    return $this->hasMany(Etudiant::class);
   }
}
