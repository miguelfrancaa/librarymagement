<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
    ];

    public function reserved(){
        return $this->belongsToMany(Book::class, 'reserves')->withTimestamps();
    }
}
