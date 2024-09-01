<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Programs;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProgramsController extends Controller
{
     public function index() : View {
        $programs = Programs::select('id', 'program_name', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at"))
        ->orderBy('created_at', 'desc')
        ->get();
        return view('programs.index', ['programs' => $programs]);
    }
    public function add(Request $request) {
        $user_id = Auth::user()->id;
        $result = Programs::create([
            'program_name' => $request->program_name,
            'program_desc' => $request->program_desc_html,
            'added_by' => $user_id
        ]);
        if($result){
            return 1;
        }else{
            return 0;
        }

        // return $result;
    }
    public function create(Request $request){
        // $user = User::all();
        // return $user;

        $res = Document::create([
            'document_name' => $request->document_name,
            'description' => $request->description,
            'status' => 0,
            'user_id' => $request->user_id,
            'path' => $request->folder_id
        ]);
        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }
    
}
