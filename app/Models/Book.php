<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function author() {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function favorited(){
        return $this->belongsToMany(User::class, 'book_user')->withTimestamps();
    }

    public function reserved(){
        return $this->belongsToMany(User::class, 'reserves')->withTimestamps();;
    }
}
