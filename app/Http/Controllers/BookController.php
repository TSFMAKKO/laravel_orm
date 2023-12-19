<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // $posts = [
        //     ['id' => 1, 'title' => 'Post 1'],
        //     ['id' => 2, 'title' => 'Post 2'],
        //     // 其他文章
        // ];

        echo "book";

        return view('book');
    }
}


