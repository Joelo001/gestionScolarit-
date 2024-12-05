<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichePaie extends Model
{
    use HasFactory;
    protected $fillable = ['enseignant_id', 'salaire_amount', 'payment_date', 'status'];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'enseignant_id');
    }
}
