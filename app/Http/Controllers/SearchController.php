<?php

namespace App\Http\Controllers;

use App\Models\Post;
use ArUtil\ArUtil;

class SearchController extends Controller
{
    
    public function index()
    {
        if (request()->has('q')) {
            $q = request()->q;
            
            $query = Post::query();
            $regexPs = ArUtil::query()->regexpy($q);
            foreach ((array)$regexPs as $regex) {
                $query->where('title', 'regexp', $regex);
                $query->orWhere('text', 'regexp', $regex);
                $query->orWhere('short_title', 'regexp', $regex);
            }
        }
        
        return view('search.index');
    }
}
