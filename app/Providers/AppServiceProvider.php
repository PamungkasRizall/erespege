<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Define the repository namespace
        $namespace = "App\\Repositories\\";
        $path = app_path('Repositories');

        // Get all PHP files in the Repositories folder
        foreach (File::allFiles($path) as $file) {
            // Get class name without .php
            $class = $namespace . pathinfo($file->getFilename(), PATHINFO_FILENAME);

            if (class_exists($class)) {
                $this->app->bind($class);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
