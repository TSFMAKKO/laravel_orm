<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookstore extends Model
{
    protected $fillable = ['user_id','name'];
    use HasFactory;

    // 多對多
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
