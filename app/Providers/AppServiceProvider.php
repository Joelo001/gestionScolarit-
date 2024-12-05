<?php

namespace App\Providers;

use App\Models\Etudiant;
use Illuminate\Support\ServiceProvider;
use App\Repository\Classes\ParentsRepository;
use App\Repository\Classes\EtudiantRepository;
use App\Repository\Interface\ParentsRepositoryInterface;
use App\Repository\Interface\EtudiantRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ParentsRepositoryInterface::class, ParentsRepository::class);
        $this->app->bind(EtudiantRepositoryInterface::class, EtudiantRepository::class);


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
