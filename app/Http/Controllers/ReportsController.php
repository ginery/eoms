<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Document;
use App\Models\User;

class ReportsController extends Controller
{
    public function index() : View {
        return view('reports.index');
    }
    public function generate(Request $request){
          
            if($request->role_id == 1){        
                $documents = Document::whereBetween(\DB::raw('DATE(date_added)'), [$request->start_date, $request->end_date])->get(); 
            }else{
                $documents = Document::whereBetween(\DB::raw('DATE(date_added)'), [$request->start_date, $request->end_date])->where('user_id', $request->user_id)->get(); 
            }
            $documents->transform(function($document) {
                $document->date_added = \Carbon\Carbon::parse($document->date_added)->format('m-d-Y');
                $document->status = getDocumentStatus($document->status);
                $document->user_id = getUserFullName($document->user_id);
                $document->document_size = $document->document_size ? number_format($document->document_size, 2)."KB":"0.00KB";
                return $document;
            });
       
        return response()->json(['data' => $documents]);
    }
}
