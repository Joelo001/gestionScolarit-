<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $fillable = ['exam_date', 'academic_year'];

    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'exam_cours', 'exam_id', 'cours_id');
    }
}
