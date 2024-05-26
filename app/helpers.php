<?php

use Carbon\Carbon;
use App\Models\Document;
use App\Models\User;
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

