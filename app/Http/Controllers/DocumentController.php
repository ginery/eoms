<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    //
    public function index() : View {
        $document  = Document::all();
        return view('documents.index',['documents'=>$document]);
    }


    public function getDocument(){
        $document  = Document::all();
        return $document;
    }

    public function getDocumentByUser($userAdded){
        $document = Document::where('user_added',$userAdded)->get();
        return $document;
    }



}
