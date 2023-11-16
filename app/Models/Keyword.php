<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    public $fillable = ['name', 'user_id'];
    public function articles(){
        return $this->belongsToMany(Article::class, 'keyword_article');
    }
}
