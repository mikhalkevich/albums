<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Album;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class FormNews extends Component
{
    public $name;
    public $description;
    public $message;
    public $product_id;
    public function save(){
    Article::create([
         'name' => $this->name,
         'description' => $this->description,
         'product_id' => $this->product_id,
         'user_id' => optional(Auth::user())->id
     ]);
     return redirect('blog');
    }
    public function render()
    {
        $albums = Album::all();
        $articles = Article::where('user_id', optional(Auth::user())->id)->orderBy('id', 'DESC')->simplePaginate(10);
        return view('livewire.form-news', compact('albums', 'articles'))->layout('layouts.app');
    }
}
