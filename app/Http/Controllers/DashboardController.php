<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Programs;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(): View{
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        // $rejected = Document::where('status', 3)->count();
        $users = User::where('role','0')->count();
        $programs = Programs::count();
        $rejected = Document::where('status', -1)->count();
        $completed = Document::where('status', 2)->count();
        $inprogress = Document::where('status', 0)->count();
        $archived = Document::where('status', 5)->count();

        $CCS = Document::join('programs', 'documents.doc_path', '=', 'programs.id')
                ->select('documents.*', 'programs.*')
                ->where('programs.program_name', 'CCS') // Select columns you need
                ->count();

        $COE = Document::join('programs', 'documents.doc_path', '=', 'programs.id')
                ->select('documents.*', 'programs.*')
                ->where('programs.program_name', 'COE') // Select columns you need
                ->count();

        $CIT = Document::join('programs', 'documents.doc_path', '=', 'programs.id')
                ->select('documents.*', 'programs.*')
                ->where('programs.program_name', 'CIT') // Select columns you need
                ->count();

        $COENG = Document::join('programs', 'documents.doc_path', '=', 'programs.id')
                ->select('documents.*', 'programs.*')
                ->where('programs.program_name', 'COENG') // Select columns you need
                ->count();
        

        if($user_role != 1){
            $projects = Roadmap::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        }else{
            $projects = Roadmap::orderBy('created_at', 'desc')->get();
        }
      

        $projects->transform(function ($project) {
            if ($project->created_at) {
                $project->formatted_date = Carbon::parse($project->created_at)->format('m/d');
            } else {
                $project->formatted_date = null; // Handle null dates gracefully
            }
            return $project;
        });
        return view('dashboard', 
        [
            'completed' => $completed, 
            'inprogress' => $inprogress, 
            'rejected' => $rejected,
            'archived' => $archived,
            'projects' => $projects,
            'programs' => $programs,
            'users'    => $users,
            'programs_css' => $CCS,
            'programs_coe' => $COE,
            'programs_cit' => $CIT,
            'programs_coeng' => $COENG
        ]);
    }

    public function test() {

        $test = sendNotification('cZ0mSUYKE90q7VXOuQPnJg:APA91bFAGKobuE_Hup4kN8lCW5JECs73Y5O2zhYz-D35xuW3IlMQydDibvACD6JyfMYRDnbmlNAPJ-nNn2EBRsC9OylbDZ4fB9LWmGvuCMBmPp51uEh9xiQ','test title','test');
        return $test;
    }

    public function getDocumentStatus(Request $request){
        
            if ($request->role_id != 0) {
                $documents = Document::where('status', $request->document_status)->where('document_size','!=', 0)->get();
                $documents->transform(function($document) {
                    $document->date_added = \Carbon\Carbon::parse($document->date_added)->format('m-d-Y');
                    $document->document_size = $document->document_size ? number_format($document->document_size, 2)."KB":"0.00KB";
                    return $document;
                });
            } else {
                $documents = Document::where('status', $request->document_status)->where('user_id', $request->user_id)->where('document_size','!=', 0)->get();
                $documents->transform(function($document) {
                    $document->date_added = \Carbon\Carbon::parse($document->date_added)->format('m-d-Y');
                    $document->document_size = $document->document_size ? number_format($document->document_size, 2)."KB":"0.00KB";
                    return $document;
                });
            }

            return $documents;
        
    }

    public function update_token (Request $request) {
        $user = User::find($request->user_id);
        $user->update([
            'notification_token' => $request->notification_token, // Use the validated token
        ]);
    }
    
}
