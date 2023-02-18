<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\AppInterfaces\InterfaceExport;
use App\AppServices\ExportExcelService;
use App\AppServices\ExportPdfService;
use App\AppServices\ExportTxtService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $class = config('services.exporting.txt');
        $this->app->bind(InterfaceExport::class, $class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
