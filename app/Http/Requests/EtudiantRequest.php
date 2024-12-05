<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EtudiantRequest extends FormRequest
{ /**
    * Determine if the user is authorized to make this request.
    */
   public function authorize(): bool
   {
       return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
   public function rules(): array
   {
    return [
        'etudiant.nom' => 'required|string|max:255',
        'etudiant.prenom' => 'required|string|max:255',
        'etudiant.adresse' => 'required|email',
        'etudiant.num_tel' => 'required|string|size:10',
        'etudiant.quartier' => 'required|string|max:255',
        'etudiant.date_naissance' => 'required|date',
        'etudiant.série' => 'required|string|max:1',
        'etudiant.niveau_academique' => 'required|string|max:255',
        'parents.full_name' => 'required|string|max:255',
        'parents.occupation' => 'required|string|max:255',
        'parents.num_tel' => 'required|string|size:10',
        'parents.addresse' => 'required|email',
    ];
   }
   public function messages()
   {
       return [
           'etudiant.nom.required' => 'Le nom de l\'étudiant est requis.',
           'etudiant.prenom.required' => 'Le prénom de l\'étudiant est requis.',
           'etudiant.adresse.required' => 'L\'adresse de l\'étudiant est requise.',
           'etudiant.num_tel.required' => 'Le numéro de téléphone de l\'étudiant est requis.',
           'etudiant.num_tel.digits' => 'Le numéro de téléphone de l\'étudiant doit être de 10 chiffres.',
           'etudiant.date_naissance.required' => 'La date de naissance de l\'étudiant est requise.',
           'etudiant.date_naissance.before' => 'La date de naissance doit être une date valide avant aujourd\'hui.',
           'parents.full_name.required' => 'Le nom complet du parent est requis.',
           'parents.occupation.required' => 'L\'occupation du parent est requise.',
           'parents.num_tel.required' => 'Le numéro de téléphone du parent est requis.',
           'parents.num_tel.digits' => 'Le numéro de téléphone du parent doit être de 10 chiffres.',
           'parents.addresse.required' => 'L\'adresse du parent est requise.',
       ];
   }
   
}
