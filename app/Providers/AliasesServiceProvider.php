<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AliasesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('GeneralHelper', \App\Helpers\GeneralHelper::class);
        $loader->alias('AssessmentHelper', \App\Helpers\AssessmentHelper::class);
        $loader->alias('QuizHelper', \App\Helpers\QuizHelper::class);
    }
}
