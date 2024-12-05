<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Présence extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'course_id', 'date', 'status'];

    public function student()
    {
        return $this->belongsTo(Etudiant::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Cours::class, 'course_id');
    }
}
