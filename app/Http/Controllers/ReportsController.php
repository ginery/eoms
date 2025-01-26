<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Document;
use App\Models\Programs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
          
        $start_date = Carbon::createFromFormat('m/d/Y', $request->start_date)->startOfDay()->toDateTimeString();
        $end_date = Carbon::createFromFormat('m/d/Y', $request->end_date)->endOfDay()->toDateTimeString();
        $min_id = Programs::min('id');

            $documents = Document::whereBetween('date_added', [$start_date, $end_date])
            ->whereNotNull('document_size');

            $role = Auth::user()->role;
          if($role != 2) {
            if ($request->user_id || $request->program_id || $request->status_id) {
                // Apply specific filters if provided
                if ($request->user_id) {
                    $documents->where('user_id', $request->user_id);
                }
                if ($request->program_id) {
                    $documents->where('doc_path', $request->program_id)->where('path', '!=', 0);
                }
                if ($request->status_id) {
                    $documents->where('status', $request->status_id);
                }
            } 

          }else {
            $documents->where('user_id', $request->user_id);
          }
          
        

  
            $document_data = $documents->get();    
            // dd(json_encode(($document_data)));
            $counter = 0;
            $document_data->transform(function($document) use (&$counter){
                $counter++;
                $document->date_added = \Carbon\Carbon::parse($document->date_added)->format('m-d-Y');
                $document->status = getDocumentStatus($document->status);
                $document->user_name = getUserFullName($document->user_id);
                $document->document_size = $document->document_size ? number_format($document->document_size, 2)."KB":"0.00KB";
                $document->counter = $counter;
                return $document;
            });
       
        return response()->json([
            'data' => $document_data,
            'payload' => [
              'program_id' => $request->program_id,
              'status_id' =>  $request->status_id,
              'user_id' =>  $request->user_id
            ]
        ]);
    }
}
