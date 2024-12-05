<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploieTemps extends Model
{
    use HasFactory;
    protected $fillable = ['enseignant_id', 'start_time', 'end_time', 'course_id'];
    protected $date =['day_of_week'];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'enseignant_id');
    }

    public function course()
    {
        return $this->belongsTo(Cours::class, 'course_id');
    }
}
