<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index () : View{
        $users = User::all();
        return view('users.index',['users' => $users]);
    }
    public function create(Request $request){
        // $user = User::all();
        // return $user;

        $res = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make('123456789'),
            'role' => $request->role,
        ]);
        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }

    public function destroy($id){
        $item = User::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }

    public function delete($id){
        $deleteItem = User::where('id',$id)->delete();
        return $deleteItem;
    }

    public function get($id){
        $getItem = User::where('id',$id)->first();
        return $getItem;
    }

    public function update(Request $request){
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
        ];

        $res = User::where('id', $request->id)->update($data);

        return $res;
    }

}
