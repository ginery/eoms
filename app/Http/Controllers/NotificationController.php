<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;

class NotificationController extends Controller
{
    // function here
    public function update() {
        $user_role = Auth::user()->role;
        $user_id = Auth::user()->id;
      
        if ($user_role != 1) {
            // Update all rows to set 'is_seen_admin' to 1
            $result = Notifications::query()
            ->where('user_id', $user_id)
            ->update([
                'is_seen' => 1,
            ]);
        } else {
            // Update all rows to set 'is_seen' to 1
            $result = Notifications::query()->update([
                'is_seen_admin' => 1,
            ]);
        }

       return $result;
        
    }
}
