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
use App\Helpers\Breadcrumbs;

class InProgressController extends Controller
{
    public function index() : View {
       // dd(json_encode($role));
       $role = Auth::user()->role;
       if($role === 1 || $role === 2){
        $document = Document::where('path', 0)->get();
        } else {
            $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
        }
        $programs = Programs::all();
        
        return view('in-progress.index', ['documents' => $document, 'programs' => $programs]);
    }
    public function folder($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $documents = Document::where('path', $id)->where('status','!=', 2)->get();
        
        return view('in-progress.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id]);
    }
}
