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

        if($role === 1){
            $document = Document::where('status', 2)->where('path','!=', 0)->get();
        } else {
            $document = Document::where('user_id', Auth::user()->id)->where('path','!=', 0)->where('document_type', null)->get();
        }
        return view('archived.index',['documents' => $document]);
    }
    public function update(Request $request) {
        $data = [
            'status' => 2,            
        ];
        $result = Document::where('id', $request->id)->update($data);
        if ($result) {
            return 1;
        } else {
            return 0;
        }

    }
    public function complete(Request $request) {
        $data = [
            'status' => 1,            
        ];
        $result = Document::where('id', $request->id)->update($data);
        if ($result) {
            return 1;
        } else {
            return 0;
        }

    }
}
