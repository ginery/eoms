<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Notifications; // Example model

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $notificationData = Notifications::all(); 
            $notificationCount = $notificationData->count();
            $view->with([
                'notificationData' => $notificationData,
                'notificationCount' => $notificationCount,
            ]);
        });
    }
}

