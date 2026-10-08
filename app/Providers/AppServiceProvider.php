<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Collection::macro('paginate', function ($perPage = 15, $currentPage = null, $options = []) {
            $currentPage = $currentPage ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
            $items = $this->forPage($currentPage, $perPage);
            $options['path'] = $options['path'] ?? LengthAwarePaginator::resolveCurrentPath();
            $options['pageName'] = $options['pageName'] ?? 'page';
        
            return new LengthAwarePaginator($items, $this->count(), $perPage, $currentPage, $options);
        });
    }
}
