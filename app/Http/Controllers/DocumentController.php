<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Helpers\Breadcrumbs;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    //
    public function index() : View {
        // $document  = Document::all();
        $role = Auth::user()->role;
        // dd(json_encode($role));
        if($role === 1){
            $document = Document::where('path', 0)->get();
        } else {
            $document = Document::where('user_id', Auth::user()->id)->where('path', 0)->get();
        }
      
        return view('documents.index',['documents'=>$document]);
    }

    public function folder($id) : View{
        $breadcrumbs = Breadcrumbs::generate();
        $documents = Document::where('path', $id)->where('status','!=', 2)->get();
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

    public function destroy(Request $request){
        $item = Document::findOrFail($request->id);
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
                    $fileName = time()."-".strtolower(str_replace(' ', '_', $originalName));
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

    public function deleteFile(Request $request)
    {
        // Validate the request to ensure 'file_name' is provided
        $request->validate([
            'file_name' => 'required|string',
        ]);

        // Define the file path
        $filePath = public_path('assets/uploads/' . $request->file_name);

        // Check if the file exists
        if (File::exists($filePath)) {
            // Attempt to delete the file
            if (File::delete($filePath)) {
                // Optionally, delete the record from the database if needed
                Document::where('document_name', $request->file_name)->delete();

                return response()->json(['success' => true, 'message' => 'File deleted successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'File could not be deleted.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'File not found.']);
        }
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);

        $filePath = asset('assets/uploads/' . $document->document_name);
        $fileType = $document->document_type;

        return response()->json([
            'document_name' => $document->document_name,
            'filePath' => $filePath,
            'fileType' => $fileType
        ]);
    }

}
