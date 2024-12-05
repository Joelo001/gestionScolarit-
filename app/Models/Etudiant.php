<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    
    protected $table ='etudiants';

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'num_tel',
        'quartier',
        'parent_id', 
        'date_naissance',
        'inscription_id', 
        'serie', 
        'niveau_academique'
    ];
    protected $guarded =['id'];
    protected $date =['date_naissance'];
    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }

    public function inscription()
    {
        return $this->hasOne(Inscription::class, 'inscription_id');
    }
    public function presence(){
        return $this->hasMany(Présence::class);
    }
}
