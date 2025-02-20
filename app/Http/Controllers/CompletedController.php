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
class CompletedController extends Controller
{
    public function index() : View {
        // dd(json_encode($role));
        $role = Auth::user()->role;
        $user_id = (string)Auth::user()->id;
        if($role === 1 || $role === 2){
         $document = Document::where('path', 0)->get();
         $programs = Programs::all();
         } else {
            $programs = Programs::whereRaw('JSON_CONTAINS(users_involve, ?)', [json_encode($user_id)])
            ->where(function ($query) use ($user_id) {
                $query->where('is_approve', 1)
                      ->orWhere(function ($query) use ($user_id) {
                          $query->where('is_approve', 0)
                                ->where('added_by', $user_id);
                      });
            })
            ->get();
             $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
         }
         
         return view('completed.index', ['documents' => $document, 'programs' => $programs]);
     }
     public function project($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        //status 0 proposed
        $documents = Document::where('path', $id)->where('status', 5)->get();
        
        return view('completed.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id]);
    }
    public function program($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $programs = Programs::where('id', $id)->get()->first();
        if($id === '-40' || $id === '-41' || $id === '-42'){
            $documents = Document::where('doc_path', $id)->whereNotNull('document_size')->where('status', 0)->get(); // terminal
        }else{
            $documents = Document::where('doc_path', $id)->whereNull('document_size')->where('status', 5)->get();
        }
        
        
        // dd(json_encode($programs));

        return view('completed.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id, 'programs' => $programs]);
    }
}
