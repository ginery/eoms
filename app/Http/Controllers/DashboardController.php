<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class DashboardController extends Controller
{
    public function index(): View{
        return view('dashboard');
    }

    public function getDocumentStatus(Request $request){
        
            if ($request->role_id == 1) {
                $documents = Document::where('status', $request->document_status)->where('document_size','!=', 0)->get();
                $documents->transform(function($document) {
                    $document->date_added = \Carbon\Carbon::parse($document->date_added)->format('m-d-Y');
                    $document->document_size = $document->document_size ? number_format($document->document_size, 2)."KB":"0.00KB";
                    return $document;
                });
            } else {
                $documents = Document::where('status', $request->document_status)->where('user_id', $request->user_id)->where('document_size','!=', 0)->get();
            }

            return $documents;
        
    }
    
}
