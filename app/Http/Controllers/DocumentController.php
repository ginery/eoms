<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Helpers\Breadcrumbs;
class DocumentController extends Controller
{
    //
    public function index() : View {
        // $document  = Document::all();
        $role = Auth::user()->role;

        if($role === 1){
            $document = Document::all();
        } else {
            $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
        }
      
        return view('documents.index',['documents'=>$document]);
    }
    public function folder($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $documents = Document::where('path', $id)->get();
        return view('documents.folder', ['breadcrumbs' => $breadcrumbs, 'documents' => $documents, 'folder_id' => $id]);
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
            'path' => $request->folder_id
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

    public function upload(Request $request){
        if ($request->hasFile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {

                    $originalName = $file->getClientOriginalName();
                    $fileName = strtolower(str_replace(' ', '_', $originalName));
                    $file->move(public_path('assets/uploads'), $fileName);
                    $fileType = $file->getClientOriginalExtension();
                    $destinationPath = public_path('assets/uploads');
                    $filePath = $destinationPath . '/' . $fileName;
                    $fileSize = filesize($filePath) / 1024;
                    $fileType = $file->getClientOriginalExtension();
                    $res = Document::create([
                        'document_name' => $fileName,
                        'document_type' => $fileType,
                        'document_size' => round($fileSize, 2),
                        'description' => '',
                        'status' => 0,
                        'user_id' => $request->user_id,
                        'path' => $request->folder_id
                    ]);
                    $uploadedFiles[] = [
                        'file_name' => $fileName,
                        'file_type' => $fileType,
                        'status'    => $res
                    ];
                } else {                 
                    return response()->json(['success' => false, 'message' => 'Invalid file uploaded.']);
                }
            }
            
            return 1;
        }

        return response()->json(['success' => false, 'message' => 'No files uploaded.']);
    
        
    }
    



}
