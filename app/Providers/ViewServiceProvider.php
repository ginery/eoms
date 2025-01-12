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
                    $notificationCount = Notifications::query()
                    ->where('user_id', $user_id)
                    ->where('is_seen', 0)
                    ->get(); 

                    $notificationData = Notifications::query()
                    ->where('user_id', $user_id)
                    ->get(); 
                }else{
                    $notificationCount = Notifications::query()
                    ->where('is_seen_admin', 0)
                    ->get(); 

                    $notificationData = Notifications::query()
                    ->get(); 
                }
            }else{
                $notificationData = Notifications::query()->get(); 
            }
            $count = $notificationCount->count();
            $view->with([
                'notificationData' => $notificationData,
                'notificationCount' => $count,
            ]);
        });
    }
}
