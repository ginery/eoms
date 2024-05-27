<?php

use Carbon\Carbon;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('format_date')) {
    function format_date($date)
    {
        return Carbon::parse($date)->format('d M Y');
    }
}
if (!function_exists('getRole')) {
    function getRole($id)
    {
        if($id === 0){
            return '<span class="label label-light-success label-inline font-weight-bold">Staff/Faculty</span>';
        }else{
            return '<span class="label label-light-info label-inline font-weight-bold">Administrator</span>';
        }
    }
}
if (!function_exists('getFolderName')) {
    function getFolderName($id)
    {
        $document = Document::where('id', $id)->get()->first();
        return $document ? $document->document_name:'N/A';
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
            return '<span class="label label-light-warning label-inline font-weight-bold">In-progress</span>';
        }else if($status == 1){
            return '<span class="label label-light-primary label-inline font-weight-bold">Completed</span>';
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
            $document = Document::where('status', $status)->count();
        }else{
            $document = Document::where('user_id', $user_id)->where('status', $status)->count();
        }
        
        
     
        return $document ? $document:0;
        
    }
}

