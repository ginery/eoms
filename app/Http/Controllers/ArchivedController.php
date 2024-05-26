<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
class ArchivedController extends Controller
{
    public function index() : View {
        $role = Auth::user()->role;

        // if($role === 1){
            $document = Document::where('user_id', Auth::user()->id)->where('status', 2)->get();
        // } else {
            // $document = Document::where('user_id', Auth::user()->id)->where('path','!=', 0)->where('document_type', null)->get();
        // }
        return view('archived.index',['documents' => $document]);
    }
}
