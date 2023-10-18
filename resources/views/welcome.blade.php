<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex flex-row">
                    @foreach($albums as $album)
                        <a href="{{asset('album/'.$album->id)}}" class="w-[200px] p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 rounded-lg ">
                            {{$album->name}} ({{$album->products->count()}})
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
