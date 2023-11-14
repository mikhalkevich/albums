<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex flex-row">
                    @foreach($albums as $album)
                        <a href="{{asset('album/'.$album->id)}}" class="bg-sky-100 text-sky-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-sky-200 hover:bg-sky-200 dark:hover:bg-sky-300 dark:text-sky-800 mb-2">
                            {{$album->name}} ({{$album->products->count()}})
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
