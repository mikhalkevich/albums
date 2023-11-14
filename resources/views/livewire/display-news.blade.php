<div>
    @foreach($articles as $article)
        <article class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
            <div class="flex items-center justify-between mb-3 text-gray-500">
                <div>
                    <a class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 hover:bg-blue-200 dark:hover:bg-blue-300 dark:text-blue-800 mb-2" href="/blog/tag/flowbite/">#Flowbite</a>
                </div>
                <span class="text-sm"> <time datetime="1677146503000">
                        <a href="#" class="text-amber-900 hover:underline">{{$article->user->name}}</a>
                        {{$article->created_at->diffForHumans()}}</time>

                </span>
            </div>

            <div class="flex">
                @if($article->picture)
                    <img src="{{asset('storage/albums/'.$article->picture->album_id.'/s_'.$article->picture->picture)}}"/>
                @else
                @endif
            <div class="mb-5 text-gray-500 dark:text-gray-400 pl-4">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:underline">
                        <a href="#" class="text-amber-900 hover:underline">{{$article->name}}</a></h2>
                {{$article->description}}
            </div>
            </div>
        </article>

    @endforeach
    <div x-data="{
    observe(){
        const observer = new IntersectionObserver((articles) => {
      articles.forEach(article => {
        if(article.isIntersecting){
          @this.loadMore()
        }
      })
     }
    )
    observer.observe(this.$el)
    }

    }" x-init="observe">
    </div>
    {{--
    @if($articles->hasMorePages())
    <div class="text-center p-2">
        <button wire:click="loadMore" class="p-1 bg-amber-700 text-white">More</button>
    </div>
    @endif
    --}}
</div>
