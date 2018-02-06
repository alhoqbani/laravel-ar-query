<?php

namespace App\Http\Controllers;

class ElasticSearchController extends Controller
{
    
    public function index()
    {
        return view('elastic.index');
    }
}
