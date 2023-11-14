<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class EditNews extends Component
{
    public function render(Article $article)
    {
        return view('livewire.edit-news', compact('article'))->layout('layouts.app');
    }
}
