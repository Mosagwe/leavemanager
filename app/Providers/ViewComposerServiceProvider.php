<?php

namespace App\Providers;

use App\Models\OrderPricing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Configurations\Citation;
use Illuminate\Support\ServiceProvider;
use App\Models\Configurations\Deadline;
use App\Models\Configurations\PaperType;
use App\Models\Configurations\Discipline;
use App\Models\Configurations\AcademicLevel;
use App\Http\ViewComposers\CountersComposer;
use App\Models\Configurations\ClientConfiguration;
use App\Models\Services\Service;
use Illuminate\Support\Facades\DB;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $views = [
            'app.nav.sidebar',
        ];

        View::composer($views, CountersComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
