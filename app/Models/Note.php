<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'exam_id', 'subject_id', 'score'];

    public function student()
    {
        return $this->belongsTo(Etudiant::class, 'student_id');
    }

    public function exam()
    {
        return $this->belongsTo(Examen::class, 'exam_id');
    }

    public function subject()
    {
        return $this->belongsTo(Matière::class, 'subject_id');
    }
}
