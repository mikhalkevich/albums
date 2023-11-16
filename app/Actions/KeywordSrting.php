<?php

namespace App\Actions;

use App\Models\Keyword;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class KeywordSrting
{

    public function add(string $keyword, $article_id = null)
    {
        $arr = explode(',', $keyword);
        foreach ($arr as $one) {
            $keyword = Keyword::firstOrCreate([
                'name' => $one,
            ], [
                'name' => $one,
                'user_id' => (Auth::user())->id
            ]);
            $keyword->articles()->syncWithoutDetaching($article_id);
        }
    }
    public function getStr($article_id = null){
        $article = Article::find($article_id);
        $keys = optional($article->keywords)->pluck('name')->toArray();
        if($keys){
            $res_k = implode(', ', $keys);
        }else{
            $res_k = optional(optional($article->picture)->album)->name . ', ';
        }
            return $res_k;
    }
}
