<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','content'];

    // 多對一(回應了誰)
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // 一對多
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
