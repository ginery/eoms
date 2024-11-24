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
class ArchivedController extends Controller
{
    public function index() : View {
        // $role = Auth::user()->role;

        // if($role === 0){
        //     $document = Document::where('user_id', Auth::user()->id)->where('path','!=', 0)->where('document_type', null)->get();
        // } else {
            $document = Document::where('status', 2)->where('document_size','!=', 0)->get();
        // }

        $programs = Programs::all();

        return view('archived.index', 
        [
            'documents' => $document, 
            'programs'  => $programs
        ]);
    }
    public function update(Request $request) {
        $data = [
            'status' => 2,            
        ];
        $result = Document::where('id', $request->id)->update($data);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
    public function complete(Request $request) {
        $data = [
            'status' => 1,            
        ];
        $result = Document::where('id', $request->id)->update($data);
        if ($result) {
            return 1;
        } else {
            return 0;
        }

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
        $documents = Document::where('doc_path', $id)->where('status', 5)->get();
        
        // dd(json_encode($programs));

        return view('completed.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id, 'programs' => $programs]);
    }
}
