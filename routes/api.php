<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EmploiTempsController;
use App\Http\Controllers\CoursController;
use App\Http\Requests\EtudiantRequest;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use Illuminate\Validation\ValidationException;

Route::post('/joelo', function (EtudiantRequest $request) {

    $data = $request->validated();
        return response()->json([
            'message' => 'Données validées avec succès.',
            'data' => $data,
        ], 200);

});





Route::prefix('students')->group(function () {
    // Route pour enregistrer un étudiant
    Route::post('student', [EtudiantController::class, 'saveStudent']);

    // Route pour récupérer tous les étudiants
    Route::get('/', [EtudiantController::class, 'findAll']);

    // Route pour mettre à jour un étudiant
    Route::put('update/{id}', [EtudiantController::class, 'updateStudent']);

    // Route pour récupérer un étudiant par email
    Route::get('{email}', [EtudiantController::class, 'findStudentByEmail']);

    // Route pour supprimer un étudiant
    Route::delete('delete/{etudiant}', [EtudiantController::class, 'deleteStudent']);
});

Route::prefix('cours')->group(function () {
    // Route pour enregistrer un cours
    Route::post('add', [CoursController::class, 'store']);
    Route::put('update/{id}', [CoursController::class, 'update']);
    Route::delete('delete/{id}', [CoursController::class, 'destroy']);
    Route::get('afficher/{id}', [CoursController::class, 'show']);
    Route::get('affichersalles/{id}', [CoursController::class, 'showClasses']);

});

Route::prefix('emploitemps')->group(function () {
    // Route pour enregistrer un cours
    Route::post('add', [EmploiTempsController::class, 'store']);
    Route::put('update/{id}', [EmploiTempsController::class, '  ']);
    Route::delete('delete/{id}', [EmploiTempsController::class, 'destroy']);
    Route::get('afficher/{id}', [EmploiTempsController::class, 'show']);
    Route::get('affichercours/{id}', [EmploiTempsController::class, 'showCours']);
    Route::get('afficherteacher/{id}', [EmploiTempsController::class, 'showTeacher']);

});
