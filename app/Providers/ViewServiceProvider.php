<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Notifications; 


class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $user_role = Auth::user()->role;
                if($user_role != 1){
                    $notificationData = Notifications::query()
                    ->where('user_id', $user_id)
                    ->get(); 
                }else{
                    $notificationData = Notifications::query()->get(); 
                }
            }else{
                $notificationData = Notifications::query()->get(); 
            }
            $notificationCount = $notificationData->count();
            $view->with([
                'notificationData' => $notificationData,
                'notificationCount' => $notificationCount,
            ]);
        });
    }
}
