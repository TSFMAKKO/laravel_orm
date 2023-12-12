<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    // 多對一(找出回應給哪個文章或頁面 )
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // 一對多(多少人回答我 有誰回答我的回文)
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
