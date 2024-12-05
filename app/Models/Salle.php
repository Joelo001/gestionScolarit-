<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'capacité', 'localisation'];

    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'cours_salles', 'salle_id', 'cours_id');
    }
}
