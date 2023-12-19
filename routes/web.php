<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookstoreController;
use App\Http\Controllers\BookController;

use App\Models\Book;
use App\Models\Bookstore;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

Route::get('/', function () {
    $books_len = Book::count();
    $booksotres_len = Bookstore::count();
    $posts_len = Post::count();
    $comments_len = Comment::count();
    $replies_len = Reply::count();
    
    // return view('welcome', ['book_len' => $$book_len]);
    return view('welcome', compact('books_len', 'booksotres_len','posts_len','comments_len','replies_len'));

});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/bookstore', [BookstoreController::class, 'index']);

Route::get('/books', function () {
    // echo "books";

    $books = Book::get();
    foreach ($books as $book) {
        # code...
        echo "<a href='/books/$book->id'>$book->title</a>";
        echo "<br>";
    }
});

Route::get('/bookstores', function () {
    // echo "bookstores";

    $bookstores = Bookstore::get();
    // dd($bookstores);
    foreach ($bookstores as $bookstore) {
        # code...
        echo "<a href='/bookstores/$bookstore->id'>$bookstore->name</a>";
        echo "<br>";
    }
});

Route::get('/bookstores/{bookstore_id}', function ($bookstore_id) {
    echo "$bookstore_id";

    $bookstore = Bookstore::find($bookstore_id);
    echo "<h2>$bookstore->name 有哪些書籍:$bookstore->name 在那些書店也有</h2>";
    $booksInBookstore = $bookstore->books;
    // echo $booksInBookstore1->books[0];
    // dd($booksInBookstore1); // 使用 dd 输出

    foreach ($booksInBookstore as $book) {
        echo "書名: " . "<a href='/books/$book->id'>$book->title</a>" . ", 書店: ";
        foreach ($book->bookstores as $bookstore) {
            echo "<a href='/bookstores/$bookstore->id'>$bookstore->name</a>" . " ";
        }
        echo  "<br>";
        // 根據實際的書籍屬性印出更多信息
    }
});

Route::get('/books/{book_id}', function ($book_id) {
    echo $book_id;

    $book = Book::find($book_id);
    echo "<h2>$book->title 那些書店:此書店還有甚麼書籍</h2>";
    $bookstoreOfBook = $book->bookstores;
    // dd($bookstoreOfBook1); // 使用 dd 输出
    foreach ($bookstoreOfBook as $bookstore) {
        echo "書店: " . "<a href='/bookstores/$bookstore->id'>$bookstore->name</a>" . ", 此書店還有: ";
        foreach ($bookstore->books as $book) {
            echo "<a href='/books/$book->id'>$book->title</a>  ";
        }
        echo  "<br>";
        echo  "<br>";
        // 根據實際的書籍屬性印出更多信息
    }
});


// Route::get('/book', [bookController::class, 'index']);


Route::get('/posts', [PostController::class, 'show']);


// kcard
Route::get('/post/{post_id}', [PostController::class, 'index']);

use App\Http\Controllers\ReplyController;

Route::get('/reply/{comment_id}', [ReplyController::class, 'index']);

use App\Http\Controllers\CommentController;

Route::get('/comment/{post_id}', [CommentController::class, 'index']);

