<?php

namespace App\Providers;

use App\Repositories\Bond\BondInterface;
use App\Repositories\Bond\BondRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
   
    public function register()
    {
        $this->app->bind(BondInterface::class,BondRepository::class);
    }

    public function boot()
    {
        //
    }
}
