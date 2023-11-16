<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Keyword;
use App\Models\ArticleBody;
use App\Models\Album;
use App\Actions\KeywordSrting;

class EditNews extends Component
{

    public Article $article;
    public $albums;
    public $name;
    public $description;
    public $message;
    public $keywords;
    public $product_id;
    public $listeners = ['defaultAlbum'];

    public function mount()
    {
        $key = (new KeywordSrting)->getStr($this->article->id);
        $this->albums = Album::all();
        $this->name = $this->article->name;
        $this->description = $this->article->description;
        $this->product_id = $this->article->product_id;
        $this->keywords = $key;
    }

    public function save()
    {
        // обновляем данные статьи
        $art = Article::find($this->article->id);
        $art->name = $this->name;
        $art->description = $this->description;
        $art->product_id = $this->product_id;
        $art->save();

        //Сохраняем основную статью
        if ($this->message) {
            $art = ArticleBody::where('article_id', $this->article->id)->first();
            if (!$art) {
                $art = new ArticleBody;
                $art->article_id = $this->article->id;
            }
            $art->body = $this->message;
            $art->save();
        }

        //сохраняем ключевые слова
        if ($this->keywords) {
            $key = (new KeywordSrting)->add($this->keywords, $this->article->id);
        }

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.edit-news')->layout('layouts.app');
    }
}
