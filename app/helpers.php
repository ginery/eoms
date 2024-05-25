<?php

use Carbon\Carbon;

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

