<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','title'];

    public function bookstores()
    {
        return $this->belongsToMany(Bookstore::class);
        // 要確保中間表有title
        // return $this->belongsToMany(Bookstore::class)
        //     ->withPivot('title')
        //     ->with('books');
            // 手动加载 books 信息;
    }
}
