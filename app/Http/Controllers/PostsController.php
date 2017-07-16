<?php

namespace App\Http\Controllers;

use App\Models\Post;
use ArUtil\ArUtil;

class PostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::all(['id', 'title']);
        
        return view('posts.index', compact('posts'));
    }
    
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    
    public function suggest()
    {
        $query = Post::query();
        $q = request('q');
        $regexPs = ArUtil::query()->regexpy($q);
        foreach ((array)$regexPs as $regex) {
            $query->where('title', 'regexp', $regex);
            $query->orWhere('short_title', 'regexp', $regex);
        }
        $posts = $query->get(['id', 'title']);
        
        return $posts->toJson();
    }
}
