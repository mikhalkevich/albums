<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-xl sm:rounded-lg mb-6">
                <div class=" p-2 ml-1 text-center text-lg font-bold">
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
