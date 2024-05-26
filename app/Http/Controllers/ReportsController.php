<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index() : View {
        return view('reports.index');
    }
    public function generate(Request $request){
        $user = Auth::user();
        // if($user->role === 1){        
            $documents = Document::whereBetween(\DB::raw('DATE(date_added)'), [$request->start_date, $request->end_date])->get(); 
        // }else{
        //     $documents = Document::whereBetween(\DB::raw('DATE(date_added)'), [$request->start_date, $request->end_date])->where('user_id', $user->id)->get(); 
        // }
            $documents->transform(function($document) {
                $document->date_added = \Carbon\Carbon::parse($document->date_added)->format('m-d-Y');
                return $document;
            });

            $documents->transform(function($document) {
                $document->status = getDocumentStatus($document->status);
                return $document;
            });

            $documents->transform(function($document) {
                $document->user_id = getUserFullName($document->user_id);
                return $document;
            });
       
        
        return response()->json(['data' => $documents]);
    }
}
