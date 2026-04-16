<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('layouts.admin', function ($view) {
            $view->with('unreadCount', ContactMessage::where('is_read', false)->count());
        });
    }
}
