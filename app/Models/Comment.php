<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','content'];

    // 多對一(找出回應給哪個文章或頁面 )
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 一對多(多少人回答我 有誰回答我的回文)
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
