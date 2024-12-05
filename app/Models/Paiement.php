<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'montant','status', 'payment_installment'];
    protected $date = ['payment_date'];
    public function student()
    {
        return $this->belongsTo(Etudiant::class, 'student_id');
    }
}
