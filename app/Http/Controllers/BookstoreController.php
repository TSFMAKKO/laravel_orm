<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookstoreController extends Controller
{
    public function index()
    {
        // $posts = [
        //     ['id' => 1, 'title' => 'Post 1'],
        //     ['id' => 2, 'title' => 'Post 2'],
        //     // 其他文章
        // ];

        echo "bookstore";

        return view('bookstore');
    }
}


