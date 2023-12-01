<?php

namespace App\Providers;

use App\Interfaces\IBookingInterface;
use App\Interfaces\INurseInterface;
use App\Interfaces\IPatientInterface;
use App\Interfaces\IPlayerInterface;
use App\Interfaces\IEmployeeInterface;
use App\Repositories\NurseRepositories;
use App\Repositories\PatientRepositories;
use App\Repositories\BookingRepositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPatientInterface::class, PatientRepositories::class);
        $this->app->bind(INurseInterface::class, NurseRepositories::class);
        $this->app->bind(IBookingInterface::class, BookingRepositories::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
