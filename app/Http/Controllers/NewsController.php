<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class NewsController extends Controller
{
    public function getIndex(){
        return view('news');
    }
    public function getOne(Article $article){
        return view('article', compact('article'));
    }
}
