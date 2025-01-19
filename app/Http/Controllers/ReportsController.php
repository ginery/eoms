<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Document;
use App\Models\Programs;
use App\Models\User;
use Carbon\Carbon;
class ReportsController extends Controller

{
    public function index() : View {
        $users = User::all(); 
        $programs = Programs::all();
        return view('reports.index', [
            'users' => $users,
            'programs' => $programs
        ]);
    }
    public function generate(Request $request){
          
        $start_date = Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d');
        $end_date = Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
        $min_id = Programs::min('id');
            if($request->role_id != 2){    
                if($request->user_id != "" && $request->program_id != "" && $request->status_id != ""){
                    $documents = Document::where(\DB::raw('DATE(date_added)'), '>=', $start_date)
                    ->where(\DB::raw('DATE(date_added)'), '<=', $end_date)
                    ->where('user_id', $request->user_id)
                    ->where('document_size','!=', 0)
                    ->where('doc_path', $request->program_id)
                    ->where('status', $request->status_id)
                    ->get(); 
                }else{
                   
                    $documents = Document::where(\DB::raw('DATE(date_added)'), '>=', $start_date)
                    ->where(\DB::raw('DATE(date_added)'), '<=', $end_date)
                    ->where('document_size','!=', 0)
                    ->where('status', '0')
                    ->where('doc_path', $min_id)
                    ->get();
                }
                

            }else{
                $documents = Document::where(\DB::raw('DATE(date_added)'), '>=', $start_date)
                ->where(\DB::raw('DATE(date_added)'), '<=', $end_date)->where('user_id', $request->user_id)->where('document_size','!=', 0)->get(); 
            }

          

            $counter = 0;
            $documents->transform(function($document) use (&$counter){
                $counter++;
                $document->date_added = \Carbon\Carbon::parse($document->date_added)->format('m-d-Y');
                $document->status = getDocumentStatus($document->status);
                $document->user_name = getUserFullName($document->user_id);
                $document->document_size = $document->document_size ? number_format($document->document_size, 2)."KB":"0.00KB";
                $document->counter = $counter;
                return $document;
            });
       
        return response()->json([
            'data' => $documents,
            'payload' => [
              'program_id' => $request->program_id,
              'status_id' =>  $request->status_id,
              'user_id' =>  $request->user_id
            ]
        ]);
    }
}
