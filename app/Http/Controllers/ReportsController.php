<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ReportsController extends Controller
{
    public function index() : View {
        return view('reports.index');
    }
}
