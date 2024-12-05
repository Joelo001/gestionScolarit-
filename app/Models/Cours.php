<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description', 'horaire', 'enseignant_id'];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'enseignant_id');
    }

    public function salles()
    {
        return $this->belongsToMany(Salle::class, 'cours_salles', 'cours_id', 'salle_id');
    }
}
