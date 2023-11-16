<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-xl sm:rounded-lg mb-6">
                <div>
                    @if($article->keywords()->count() > 0)
                        @foreach($article->keywords()->get() as $keyword)
                            <a class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 hover:bg-blue-200 dark:hover:bg-blue-300 dark:text-blue-800 mb-2"
                               href="{{asset('keyword/'.$keyword->id)}}">{{$keyword->name}}</a>
                        @endforeach
                    @else
                        Альбом: <a class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 hover:bg-blue-200 dark:hover:bg-blue-300 dark:text-blue-800 mb-2"
                                   href="{{asset('album/'.optional($article->picture)->album_id)}}">{{optional(optional($article->picture)->album)->name}}</a>
                    @endif
                </div>

                <div class=" p-2 ml-1 mb-2 text-center text-3xl font-bold">
                    {{$article->name}}
                </div>
                <div class="mb-3 text-gray-500">
                    <div class="pb-4">{!! $article->description !!}</div>
                    <div class="text-center w-full">
                    <img class="text-center m-auto p-auto" src="{{asset('storage/albums/'.$article->picture->album_id.'/'.$article->picture->picture)}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
