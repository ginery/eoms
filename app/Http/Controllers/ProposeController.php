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
    public function project($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $documents = Document::where('path', $id)->where('status','!=', 2)->get();
        
        return view('propose.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id]);
    }
    public function program($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $programs = Programs::where('id', $id)->get()->first();
        $documents = Document::where('path', $id)->where('status','!=', 2)->get();
        
        // dd(json_encode($programs));

        return view('propose.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id, 'programs' => $programs]);
    }
    public function create(Request $request){
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
