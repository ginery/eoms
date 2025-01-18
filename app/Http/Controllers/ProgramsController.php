<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Programs;
use App\Models\Messages;
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

        $users = User::where('role', 0)->get();
        return view('programs.index', 
        [
            'programs' => $programs,
            'users'     => $users
        ]);
    }
   
    public function add(Request $request) {
        $user_id = Auth::user()->id;

        $existingProgramName = Programs::where('program_name', $request->program_name)->first();
    
        if ($existingProgramName) {
            echo 2;
            return;
        }
        $result = Programs::create([
            'program_name' => $request->program_name,
            'program_desc' => $request->program_desc_html,
            'users_involve' => json_encode($request->users_involve), // select multiple
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
        $existingDocument = Document::where('document_name', $request->document_name)->first();
    
        if ($existingDocument) {
            echo 2;
            return;
        }

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
    public function get_info($id) {

        $programs = Programs::where('id', $id)->get()->first();
        return $programs;
    }  
    public function get_user($id) {

        $user = User::where('program_assigned', $id)->get();
        return $user;
    } 
    
    public function get_comments($id) {
        $user_id = Auth::user()->id;

        $documents = Document::where('id', $id)->get()->first();
        $documents['date_added'] = Carbon::parse($documents['date_added'])->format('m/d');
        $messages = Messages::where('project_id', $id)->get()->map(function($message) {
            // Add sender full name using a helper or model relationship
            $message->sender_name = getUserFullName($message->sender_id); 
            return $message;
        });


        return [
            'documents' => $documents,
            'messages' => $messages
        ];
    }
    public function add_comments(Request $request) {
        $user_id = Auth::user()->id;
        $result = Messages::create([
            'message_content'   => $request->comment,
            'sender_id'         => $user_id,
            'project_id'        => $request->document_id,
            'date_added'        => Carbon::now()
        ]);
        return $result;
    }

    public function get($id){
        $getItem = Programs::where('id',$id)->first();
        return $getItem;
    }

    public function delete($id) {      

        $deleteItem = Programs::where('id', $id)->delete();
        return $deleteItem;
      
    }

    public function update(Request $request){
        $data = [
            'program_name' => $request->program_name,
            'program_desc' => $request->update_program_desc_html,
            'users_involve' => json_encode($request->users_involve), // select multiple
        ];

        $res = Programs::where('id', $request->id)->update($data);

        return $res;
    }

    
}
