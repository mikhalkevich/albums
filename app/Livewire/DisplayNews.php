<?php

namespace App\Livewire;
use App\Models\Article;
use Livewire\Component;

class DisplayNews extends Component
{
    public $perPage = 4;
    public function loadMore(){
        $this->perPage += 4;
    }
    public function render()
    {
        return view('livewire.display-news', [
            'articles' => Article::orderBy('id', 'DESC')->paginate($this->perPage)
        ]);
    }
}
