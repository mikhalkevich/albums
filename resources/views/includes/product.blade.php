@foreach($album->products()->orderBy('id', 'DESC')->get() as $product)
    <div
        class="w-full h-full bg-gray-100 drop-shadow-md rounded-lg p-1 flex flex-1 flex-col justify-between items-center">
        <div class="">
            <h3 class="text-lg p-1">

                {{$product->name}}
            </h3>
            <a href="{{asset('product/'.$product->id)}}" class=" block">
                <img class="object-cover rounded-tl-lg rounded-tr-lg"
                     src="{{asset('storage/albums/'.$album->id.'/s_'.$product->picture)}}"/>
            </a>
        </div>
        <div class="text-center pt-3 w-full bg-white rounded">

            <p class="space-x-2 grid grid-cols-2 items-center">
            <div class="float-left">
                @if(\App\Models\Likes::where('product_id', $product->id)->where('ip', request()->ip())->count() > 0)
                    <a href="{{asset('product/'.$product->id.'/like_del')}}"><img
                            src="{{asset('img/dislike-svgrepo-com.svg')}}" class="float-left mr-3 ml-2" width="20px"/></a>
                @else
                    <a href="{{asset('product/'.$product->id.'/likes?znak=minus')}}"><img
                            src="{{asset('img/like-svgrepo-com.svg')}}" class="float-left mr-3 ml-2" width="20px"/></a>
                @endif
                <span class="text-lg text-gray-500">{{$product->totals()}}</span>
            </div>
            <div class="float-right">
                <img src="{{asset('img/comment_35.png')}}" class="float-left mr-2" width="20px"/>
                <a href="{{asset('product/'.$product->id)}}" class="mr-2">{{$product->comments->count()}}</a>
            </div>
            </p>
        </div>
    </div>
@endforeach
