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
// this is REICO
class InProgressController extends Controller
{
    public function index() : View {
       // dd(json_encode($role));
       $role = Auth::user()->role;
       $user_id = (string)Auth::user()->id;
       if($role != 0){
           $programs = Programs::all();
           $document = Document::where('path', 0)->get();
        } else {
           $programs = Programs::whereRaw('JSON_CONTAINS(users_involve, ?)', [json_encode($user_id)])->get();
           $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
        }
        
        return view('in-progress.index', ['documents' => $document, 'programs' => $programs]);
    }
    public function project($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        //status 0 proposed
        $documents = Document::where('path', $id)->where(function($query) {
            $query->where('status', 2)
                  ->orWhere('status', 2);
        })->get();
        
        return view('in-progress.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id]);
    }
    public function program($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $programs = Programs::where('id', $id)->get()->first();
        $documents = Document::where('doc_path', $id)->where(function($query) {
            $query->where('status', 2)
                  ->orWhere('status', 2);
        })->get();
        
        // dd(json_encode($programs));

        return view('in-progress.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id, 'programs' => $programs]);
    }
}
