<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'série', 'payment_status'];
    protected $date = ['academic_year'];
    public function student()
    {
        return $this->belongsTo(Etudiant::class, 'student_id');
    }
}
