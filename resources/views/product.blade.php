<x-app-layout>

    <div class=" p-2 ml-1 text-center text-lg">
        <a href="{{asset('album/'.$product->album_id)}}"
           class="text-amber-900 hover:underline">{{$product->album->name}}</a> /
        {{$product->name}}
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 ">
                    <div class="w-full p-1 flex items-center justify-center">
                        <div class="">
                            @if($product->user_id == optional(auth()->user())->id)
                            <a href="{{asset('product/'.$product->id.'/delete')}}" class="float-right text-3xl m-2">&times;</a>
                            @endif
                                <img class="object-cover rounded-tl-lg rounded-tr-lg"
                                 src="{{asset('storage/albums/'.$product->album_id.'/'.$product->picture)}}"/>
                        </div>
                    </div>
                    @if(\App\Models\Likes::where('product_id', $product->id)->where('ip', request()->ip())->count() > 0)
                        <a href="{{asset('product/'.$product->id.'/like_del')}}"><img
                                src="{{asset('img/dislike-svgrepo-com.svg')}}" class="float-left mr-3 ml-2" width="20px"/></a>
                    @else
                        <a href="{{asset('product/'.$product->id.'/likes?znak=minus')}}"><img
                                src="{{asset('img/like-svgrepo-com.svg')}}" class="float-left mr-3 ml-2" width="20px"/></a>
                    @endif
                    <span class="text-lg text-gray-500">{{$product->totals()}}</span>
                    <div>
                        @if(auth()->guest())
                            <div>Чтобы добавить комментарий, необходима авторизация
                                <a href="{{asset('login')}}" class="text-amber-900 underline hover:no-underline font-bold">login</a>
                                <a href="{{asset('register')}}" class="text-amber-900 underline hover:no-underline font-bold">register</a>
                            </div>
                        @else
                            <form action="{{asset('/product/'.$product->id.'/comment_add')}}" method="post" class="pb-5">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">
                                        Новый комментарий
                                    </label>
                                    <textarea
                                        required
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="comment"
                                        placeholder="Введите свой комментарий"
                                        name="body"
                                    ></textarea>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button
                                        class="w-[200px] p-2  font-medium text-white text-center bg-sky-600 hover:bg-sky-800 rounded-lg"
                                        type="submit"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </form>
                        @endif
                        @foreach($comments as $comment)
                                <div class="p-2 border-t-2">
                                    <div class="float-right">
                                        {{$comment->created_at->diffForHumans()}}
                                    </div>
                                    {{$comment->body}}
                                </div>
                        @endforeach
                        <div class="flex items-center justify-center">
                            {!! $comments->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
