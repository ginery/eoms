<?php

use Carbon\Carbon;
use App\Models\Document;
use App\Models\Programs;
use App\Models\User;
use App\Models\Roadmap;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Mockery\Undefined;

if (!function_exists('format_date')) {
    function format_date($date)
    {
        return Carbon::parse($date)->format('d M Y');
    }
}
if (!function_exists('getRole')) {
    function getRole($id)
    {
        if ($id === null) {
            return 'test';
        }

        if($id === 0){
            return '<span class="label label-light-success label-inline font-weight-bold">Faculty</span>';
        }else if($id === 2){
            return '<span class="label label-light-warning label-inline font-weight-bold">Staff</span>';
        }else if($id === 3){
            return '<span class="label label-light-primary label-inline font-weight-bold">REICO</span>';
        }
        else{
            return '<span class="label label-light-info label-inline font-weight-bold">Administrator</span>';
        }
    }
}
if (!function_exists('getFolderNameDocs')) {
    function getFolderNameDocs($id)
    {
        $folder_name = Document::where('id', $id)->get()->first();
        return $folder_name ? $folder_name->document_name: 'N/A';
    }
}
if (!function_exists('getFolderName')) {
    function getFolderName($id)        
    {
      
        if($id === '-40'){
            $folder_name = "Terminal Report";
            return $folder_name; 
        }else  if($id === '-41'){
            $folder_name = "Documentation";
            return $folder_name;
        }else  if($id === '-42'){
            $folder_name = "Assessment";
            return $folder_name;
        }else{
            $folder_name_data = Programs::where('id', $id)->get()->first();
            $folder_name = $folder_name_data->program_name;
            return $folder_name_data ? $folder_name:'N/A';
        }
        
       
    }
}
if (!function_exists('getUserFullName')) {
    function getUserFullName($id)
    {
        $user = User::where('id', $id)->get()->first();
        return $user ? $user->first_name." ".$user->last_name:'N/A';
    }
}
if(!function_exists('getDocumentStatus')){
    function getDocumentStatus($status)
    {
        if($status == 0){
            return '<span class="label label-light-warning label-inline font-weight-bold">Pending</span>';
        }else if($status == -1){
            return '<span class="label label-light-danger label-inline font-weight-bold">Rejected</span>';
        }else if($status == 1){
            return '<span class="label label-light-warning label-inline font-weight-bold">Technical Review</span>';
        }else if($status == 5){
            return '<span class="label label-light-dark label-inline font-weight-bold">Completed</span>';
        }else if($status == 2){
            return '<span class="label label-light-primary label-inline font-weight-bold">In-house</span>';
        }else if($status == 3){
            return '<span class="label label-light-info label-inline font-weight-bold">REICO</span>';
        }else if($status == 4){
            return '<span class="label label-light-success label-inline font-weight-bold">Implemented</span>';
        }else{
            return '<span class="label label-light-info label-inline font-weight-bold">Archived</span>';
        }
    }
}


if(!function_exists('getTotalFileStatus')){
    function getTotalFileStatus($status)
    {   
        $user_id = Auth::user()->id;
        $role = Auth::user()->role;
        if($role == 1){
            $document = Document::where('status', $status)->where('document_size','=', 0)->count();
        }else{
            $document = Document::where('user_id', $user_id)->where('status', $status)->where('document_size','=', 0)->count();
        }
        
        
     
        return $document ? $document:0;
        
    }
}

if(!function_exists('getTotalProject')){
    function getTotalProject($program_id, $status){   
        if($program_id === '-40' || $program_id === '-41' || $program_id === '-42'){
            $document = Document::where('doc_path', $program_id)->where('status', 0)->count();        
        }else{
            $document = Document::where('doc_path', $program_id)->where('path', 0)->where('status', $status)->count();        
        }
         
        
        return  $document ?  $document : 0;
        
    }
}

if(!function_exists('sendNotification')){
    function sendNotification($tokens, $title, $body)
    {
        // Path to the service account key JSON
        $serviceAccountPath = storage_path('app/firebase/firebase-service-account.json');

        // Initialize Firebase
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);
        $messaging = $factory->createMessaging();

        // Notification payload
        $notification = [
            'title' => $title,
            'body' => $body,
        ];

        // Cloud message
        $message = CloudMessage::fromArray([
            'notification' => $notification,
            'token' => $tokens,
        ]);
        // Send the notification
        try {
            $messaging->sendMulticast($message, $tokens);
            return ['success' => true, 'message' => 'Notification sent successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

}
if(!function_exists('insertRoadMap')){ 
    function insertRoadMap($data)
    {
        Roadmap::insert($data);
    }
}
if(!function_exists('insertNotification')){ 
    function insertNotification($data)
    {
        Notifications::insert($data);
    }
}
if(!function_exists('roadmapStatus')){ 
    function roadmapStatus($status)
    {
        switch ($status) {
            case 0:
                return 'warning';
                break;
            
            case 1:
                // Action for in-progress status
                return 'success';
                break;
            
            case 2:
                // Action for completed status
                return 'success';
                break;
                
            case -1:
                return 'danger';
                break;
            
            case 4:
                return 'primary';
                break;
            case 3:
                return 'success';
                break;
                
            default:
                return 'primary';
        }
    }
}

if(!function_exists('getProjectStatus')){
    function getProjectStatus($status)
    {   
        switch ($status) {
            case 0:
                return 'propose';
                break;            
            case 1:
                // Action for in-progress status
                return 'technical-review';
                break;
            
            case 2:
                // Action for completed status
                return 'in-house';
                break;
                
            case -1:
                return 'rejected';
                break;  
            case 3:
                return 'in-progress';
                break;          
            
            case 4:
                return 'implementation';
                break;
            case 5:
                return 'completed';
                break;
            case 6:
                return 'archived';
                break;
                
            default:
                return 'propose';
        }
        
    }
}

if (!function_exists('getProjectName')) {
    function getProjectName($id)
    {   
        $document = Document::where('id', $id)->first();        
        return $document ? $document->document_name : 'N/A';
    }
}

