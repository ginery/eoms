<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;

class DocumentController extends Controller
{
    //
    public function index() : View {
        // $document  = Document::all();
        $role = Auth::user()->role;

        if($role === 1){
            $document = Document::all();
        } else {
            $document = Document::where('user_id', Auth::user()->id)->get();
        }
      
        return view('documents.index',['documents'=>$document]);
    }


    public function getDocument(){
        $document  = Document::all();
        return $document;
    }

    public function getDocumentByUser($userAdded){
        $document = Document::where('user_id',$userAdded)->get();
        return $document;
    }

    public function getDocumentToEdit($id){
        $document = Document::where('id',$id)->get();
        return $document;
    }

    public function destroy($id){
        $item = Document::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }

    public function create(Request $request){
        // $user = User::all();
        // return $user;

        $res = Document::create([
            'document_name' => $request->document_name,
            'description' => $request->description,
            'status' => 0,
            'user_id' => $request->user_id,
        ]);
        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }

    public function update(Request $request){
        $data = [
            'document_name' => $request->document_name,
            'description' => $request->description,
        ];

        $res = Document::where('id', $request->id)->update($data);

        return $res;
    }



}
