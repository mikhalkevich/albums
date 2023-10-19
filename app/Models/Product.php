<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function album(){
        return $this->belongsTo(Album::class, 'album_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Likes::class, 'product_id');
    }
    public function totals(){
        return $this->likes->count();
    }
}
