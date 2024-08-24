<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Programs;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
class ProposeController extends Controller
{
    public function index() : View {
        $role = Auth::user()->role;
        if($role === 1 || $role === 2){
         $document = Document::where('path', 0)->get();
         } else {
             $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
         }
         $programs = Programs::all();
        return view('propose.index', ['documents' => $document, 'programs' => $programs]);
    }
}
