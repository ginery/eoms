<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Models\Programs;
use App\Models\Document;
use App\Helpers\Breadcrumbs;

class TechnicalReviewController extends Controller
{
    // function here
    public function index(): View {
        $role = Auth::user()->role;
        $user_id = (string)Auth::user()->id;
        if($role != 0){
            $programs = Programs::all();
            $document = Document::where('path', 0)->get();
         } else {
            $programs = Programs::whereRaw('JSON_CONTAINS(users_involve, ?)', [json_encode($user_id)])->get();
            $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
         }
        return view('technical-review.index', ['documents' => $document, 'programs' => $programs]);
    }

    public function project($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        //status 0 proposed
        $documents = Document::where('path', $id)->where('status', 1)->get();
        
        return view('technical-review.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id]);
    }
    public function program($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $programs = Programs::where('id', $id)->get()->first();
        $documents = Document::where('doc_path', $id)->whereNull('document_size')->where('status', 1)->get();
        
        // dd(json_encode($programs));

        return view('technical-review.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id, 'programs' => $programs]);
    }
    public function create(Request $request){
        $res = Document::create([
            'document_name' => $request->document_name,
            'description' => $request->description,
            'status' => 0,
            'user_id' => $request->user_id,
            'doc_path' => $request->folder_id
        ]);
        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }
    public function view_details($id){
        $documents = Document::where('id', $id)->where('status', 0)->first();

        if ($documents) {
            // Mutate or transform the data
            $documents->program_name = getProjectName($documents->id); // Add a formatted date
            $documents->formatted_date = $documents->created_at->format('d-m-Y');
            $documents->status_text = getDocumentStatus($documents->status);
        }

        return $documents;
    }
}
