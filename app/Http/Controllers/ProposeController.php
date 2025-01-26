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
        $user_id = (string)Auth::user()->id;
        if($role != 0){
            $programs = Programs::all();
            $document = Document::where('path', 0)->get();
         } else {
            $programs = Programs::whereRaw('JSON_CONTAINS(users_involve, ?)', [json_encode($user_id)])->get();
            $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
         }
       
        return view('propose.index', 
        [
            'documents' => $document, 
            'programs' => $programs, 
            'user_id' => $user_id
        ]);
    }
    public function project($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $role = Auth::user()->role;
        $user_id = (string)Auth::user()->id;
        //status 0 proposed
        if($role != 0){
            $documents = Document::where('path', $id)->where('status', 0)->get();
        }else{
            $documents = Document::whereRaw('JSON_CONTAINS(users_involved, ?)', [json_encode($user_id)])->where('path', $id)->where('status', 0)->get();
        }

       
        
        return view('propose.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id]);
    }
    public function program($id) : View{
        $role = Auth::user()->role;
        $user_id = (string)Auth::user()->id;

        $breadcrumbs = Breadcrumbs::generate();
        $programs = Programs::where('id', $id)->get()->first();
        $userIds = json_decode($programs->users_involve);
        if($role != 0){
            $documents = Document::where('doc_path', $id)->whereNull('document_size')->where('status', 0)->get();
         } else {
            $documents = Document::where('doc_path', $id)->where('status', 0)->whereRaw('JSON_CONTAINS(users_involved, ?)', [json_encode($user_id)])->get();
         }
        // $documents = Document::where('doc_path', $id)->where('status', 0)->get();
        // ->whereRaw('JSON_CONTAINS(users_involved, ?)', [json_encode($user_id)])
        $userDetails  = array_map(function ($userId) {
            return [
                'id' => $userId,
                'name' => getUserFullName($userId) // Call your helper function here
            ];// Call your helper function here
        }, $userIds);

        $programs->user_details  = $userDetails;




        // dd(json_encode($programs));

        return view('propose.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id, 'programs' => $programs]);
    }
    public function create(Request $request){
            $user_id = Auth::user()->id;
        
            $existingDocument = Document::where('document_name', $request->document_name)->first();
    
            if ($existingDocument) {
                return response()->json([
                    'success' => false,
                    'message' => 'Document name already exists'
                ], 422);
            }
            // Create the document if validation passes
            $res = Document::create([
                'document_name' => $request->document_name,
                'description' => $request->description,
                'status' => 0,
                'user_id' => $request->user_id,
                'doc_path' => $request->folder_id,
                'assigned_leader' => $user_id,
                'users_involved' => json_encode($request->users_involve),
            ]);
    
            // Check if document was created successfully
            if ($res) {
                echo 1; // Success
            } else {
                echo 0; // Failure
            }
    
         

    }
    public function view_details(Request $request){
        $documents = Document::where('id', $request->id)->where('status', $request->status)->first();

        if ($documents) {
            $userIds = json_decode($documents->users_involved);
            // dd(json_encode($userIds));
            // Mutate or transform the data
            $documents->program_name = getProjectName($documents->id); // Add a formatted date
            $documents->formatted_date = $documents->created_at->format('d-m-Y');
            $documents->status_text = getDocumentStatus($documents->status);
            $documents->user_name = getUserFullName($documents->user_id);
            $userDetails  = array_map(function ($userId) {
                return [
                    'id' => $userId,
                    'name' => getUserFullName($userId) // Call your helper function here
                ];// Call your helper function here
            }, $userIds);
    
            $documents->user_details  = $userDetails;


        }

        // dd(json_encode($documents));

        return $documents;
    }
}
