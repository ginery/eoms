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
            if($segment === '-40'){
                $name = "Terminal Report";
            }else  if($segment === '-41'){
                $name = "Documentation";
            }else  if($segment === '-42'){
                $name = "Assessment";
            }else{
                $name = preg_match('/\d+/', $segment) ? getFolderNameDocs($segment) : ucfirst(str_replace('-', ' ', $segment));
            }
              
                $breadcrumbs[] = [
                    'name' => $name,
                    'url' => url($url)
                ];
        }
    
        return $breadcrumbs;
    }
}
