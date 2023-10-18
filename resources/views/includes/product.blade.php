@foreach($album->products()->orderBy('id', 'DESC')->get() as $product)
    <div class="w-full h-full bg-white drop-shadow-md rounded-lg p-1 flex flex-1 flex-col justify-between items-center">
        <div>
            <h3 class="text-lg p-1">

                {{$product->name}}
            </h3>
            <a href="{{asset('product/'.$product->id)}}" class=" block">
                <img class="object-cover rounded-tl-lg rounded-tr-lg"
                     src="{{asset('storage/albums/'.$album->id.'/s_'.$product->picture)}}"/>
            </a>
        </div>
        <div class="text-center pt-3">

            <p class="space-x-2 grid grid-cols-5 items-center">
                <span></span>
                <a href="#"><img src="{{asset('img/like-svgrepo-com.svg')}}" width="20px"/></a>
                <span class="text-lg text-gray-500">0</span>
                <a href="#"><img src="{{asset('img/dislike-svgrepo-com.svg')}}" width="20px"/></a>
                <span></span>
            </p>
            <div
                class="mt-auto px-6 py-3 text-center text-amber-900 hover:underline">
                <a href="{{asset('product/'.$product->id)}}">Коментарии: {{$product->comments->count()}}</a>
            </div>
        </div>
    </div>
@endforeach
