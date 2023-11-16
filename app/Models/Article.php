<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'product_id', 'status', 'user_id'];
    public function picture(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function keywords(){
        return $this->belongsToMany(Keyword::class, 'keyword_article');
    }
    public function body(){
        return $this->hasOne(ArticleBody::class);
    }
}
