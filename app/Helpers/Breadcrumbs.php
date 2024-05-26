<?php
// app/Helpers/Breadcrumbs.php

namespace App\Helpers;

class Breadcrumbs
{
    public static function generate()
    {
        $segments = request()->segments();
        $breadcrumbs = [];
        $url = '';
    
        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $name = preg_match('/\d+/', $segment) ? getFolderName($segment) : ucfirst(str_replace('-', ' ', $segment));
            $breadcrumbs[] = [
                'name' => $name,
                'url' => url($url)
            ];
        }
    
        return $breadcrumbs;
    }
}
