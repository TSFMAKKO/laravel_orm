<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'content'];

    // 一對多
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 多對一(找出回應給哪個文章或頁面 )
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
