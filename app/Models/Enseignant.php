<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom',
        'prenom',
        'adresse',
        'numero_tel',
        'quartier'

    ];
    protected $guarded =['id'];
    protected $hidden = ['created_at','updated_at','departement_id','enseignant_id'];

    public function departement(){
        return $this->hasOne(Departement::class);
    }
    public function fichepaie(){
        return $this->hasOne(FichePaie::class);
    }
    public function cours(){
        return $this->hasMany(Cours::class);
    }
    public function emploieTemps(){
        return $this->hasOne(EmploieTemps::class);
    }
}
