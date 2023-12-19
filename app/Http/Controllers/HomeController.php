<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Bookstore;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postId = 1;
        // $post = Post::with('comments')->find($postId);
        // dd($post)->comments;
        // dd($post);
        // 找出post id=1的資料, 那withcomments幹嘛??
        // dd(Post::find(1));
        // 相等於

        // 所以 應該是 多with一 find 多的id才有意義吧!?
        // 那代表啥


        // 一對多 尋找一的文章(網址) 所有的回文
        $post = Post::with("comments")->find(1);
        $comments = $post->comments;
        // dd($comments);

        foreach ($comments as $key => $value) {
            # code...
            echo $key . ':  ' . $value->content . '<br>';
        }

        // dd(Comment::with('post')->find(1));
        // dd(Post::with('comments')->find(1));

        // 有意義
        // 5 15 30(5x3x2)
        // 會返回對應post id的comment的三筆資料(一對多 顯示多)
        // dd(Post::find(1)->comments);
        // dd(Comment::with('replies')->find(1)->replies);
        $comment = Comment::with('replies')->find(1);
        $replies = $comment->replies;
        echo "<br>";
        // echo $replies[0];
        // dd($replies[0]->comment->content);
        // dd(Post::with('comments')->find(3)->comments);

        // 輸出文章標題
        $post = Post::with('comments')->find(1);
        echo "Post Title: " . $post->title . "\n";

        echo "<br><br>";
        // 遍歷評論
        // foreach ($post->comments as $comment) {
        //     echo "post title: " . $comment->post->title . "  Comment ID: " . $comment->id . ", Content: " . $comment->content . "\n";
        // }


        // 


        // 创建两个书店
        // $bookstore1 = Bookstore::create(['name' => 'Bookstore A']);
        // $bookstore2 = Bookstore::create(['name' => 'Bookstore B']);

        // 创建两本书
        // $book1 = Book::create(['title' => 'Book 1']);
        // $book2 = Book::create(['title' => 'Book 2']);

        // // 在书店中添加书籍
        $bookstore1 = Bookstore::find(1);
        // // dd($bookstore1);
        $bookstore2 = Bookstore::find(2);
        $book1 = Book::find(1);
        $book2 = Book::find(2);
        // // dd($book1->id);
        // $bookstore1->books()->attach([$book1->id, $book2->id]);
        // $bookstore2->books()->attach($book2->id);

        // $bookstore2 = Bookstore::find(2);
        // $book2 = Book::find(2);

        // $bookstore2->books()->attach($book2->id);
        // dd();

        // 其實不用with沒關係
        // $bookstore1 = Bookstore::with('books')->find(1);
        // 書店一的所有書
        echo "<h1>資料庫多對多範例</h1><br>";
        
        echo "<h2>書店一有哪些書籍:此書在那些書店也有</h2>";
        $booksInBookstore1 = $bookstore1->books;
        // echo $booksInBookstore1->books[0];
        // dd($booksInBookstore1); // 使用 dd 输出

        foreach ($booksInBookstore1 as $book) {
            echo "書名: " . $book->title . ", 書店: "  ;
            foreach ($book->bookstores as $bookstore) {
                echo $bookstore->name." ";
            }
            echo  "<br>";
            // 根據實際的書籍屬性印出更多信息
        }


        echo  "<br><br><br>";


        
        echo "<h2>書店二有哪些書籍:此書在那些書店也有</h2>";
        $booksInBookstore2 = $bookstore2->books;
        // dd($booksInBookstore2); // 使用 var_dump 输出
        foreach ($booksInBookstore2 as $book) {
            echo "書名: " . $book->title .", 書店: "  ;
            foreach ($book->bookstores as $bookstore) {
                echo $bookstore->name." ";
            }
            echo  "<br>";
            // 根據實際的書籍屬性印出更多信息
        }


        echo  "<br><br><br>";

        // 获取book1在哪些書店
        
        echo "<h2>書本1尋找在那些書店:此書店還有甚麼書籍</h2>";
        $bookstoreOfBook1 = $book1->bookstores;
        // dd($bookstoreOfBook1); // 使用 dd 输出
        foreach ($bookstoreOfBook1 as $bookstore) {
            echo "書店: " . $bookstore->name . ", 販賣的書有: "  ;
            foreach ($bookstore->books as $book) {
                echo $book->title." ";
            }
            echo  "<br>";
            echo  "<br>";
            // 根據實際的書籍屬性印出更多信息
        }


        echo  "<br><br><br>";

        echo "<h2>書本2尋找在那些書店:此書店還有甚麼書籍</h2>";
        // 获取book2在哪些書店
        $bookstoreOfBook2 = $book2->bookstores;
        // dd($bookstoreOfBook2); // 使用 var_dump 输出
        foreach ($bookstoreOfBook2 as $bookstore) {
            echo "書店: " . $bookstore->name . ", 販賣的書有: "  ;
            foreach ($bookstore->books as $book) {
                echo $book->title." ";
            }
            echo  "<br>";
            // 根據實際的書籍屬性印出更多信息
        }


        echo  "<br><br><br>";

        // echo $post[0];
        // 使用 implode 將陣列轉換為字串，並使用逗號作為分隔符
        // $resultString = implode(', ', array_keys($data[0]));

        // 輸出結果字串
        // echo $resultString;
        // 遍歷陣列並印出每個 key
        // foreach (array_keys($data[0]) as $key => $value) {
        //     echo "Key: $value\n";
        // }

        // 查詢 ID 為 1 的評論及其相關回覆，並輸出 SQL 查詢語句
        // \DB::listen(function ($query) {
        //     var_dump($query->sql, $query->bindings);
        // });

        // $comment = Comment::with('replies')->find(1);



        // $post2=



        return view('home');
    }
}
