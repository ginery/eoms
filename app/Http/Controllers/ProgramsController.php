<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Programs;
use Carbon\Carbon;
class ProgramsController extends Controller
{
     public function index() : View {
        $programs = Programs::select('id', 'name', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at"))
        ->orderBy('created_at', 'desc')
        ->get();
        return view('programs.index', ['programs' => $programs]);
    }
    public function add(Request $request) {

        $result = Programs::create([
            'program_name' => $request->program_name,
            'program_desc' => $request->program_desc_html
        ]);
        if($result){
            return 1;
        }else{
            return 0;
        }

        // return $result;
    }
    
}
