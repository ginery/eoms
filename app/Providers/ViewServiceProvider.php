<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Notifications; 


class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $user_role = Auth::user()->role;
                $notificationCount = new Collection(); // Default empty collection
                $notificationData = new Collection(); // Default empty collection
                
                if($user_role === 0){
                    $notificationCount = Notifications::query()
                    ->where('user_id', $user_id)
                    ->where('is_seen', 0)
                    ->get(); 

                    $notificationData = Notifications::query()
                    ->where('user_id', $user_id)
                    ->orderBy('created_at', 'desc')
                    ->get(); 
                }else{
                    $notificationCount = Notifications::query()
                    ->where('is_seen_admin', 0)
                    ->get(); 

                    $notificationData = Notifications::query()
                    ->orderBy('created_at', 'desc')
                    ->get(); 
                }
            }else{
                $notificationData = Notifications::query()->get(); 
            }
            if (Auth::check()) {
            $count = $notificationCount->count();
            } else {
                $count = 0;
            }
            $view->with([
                'notificationData' => $notificationData,
                'notificationCount' => $count,
            ]);
        });
    }
}
