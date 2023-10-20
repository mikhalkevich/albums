<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex flex-row">
                    <form method="post" action="{{asset('album')}}" class="w-full">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Название альбома
                            </label>
                            <input type="text"
                                   required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   id="name"
                                   placeholder="Введите название альбома"
                                   name="name"/>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                                Описание
                            </label>
                            <textarea
                                required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="body"
                                placeholder="Введите описание альбома"
                                name="body"
                            ></textarea>
                        </div>
                        <button type="submit"
                                class="p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Save
                        </button>
                    </form>
                </div>
                <div class="w-full p-6 lg:p-8">
                <table class="table-auto w-full bg-white">
                    <thead class="w-full">
                    <tr>
                        <th>Название альбома</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody class="w-full">
                    @foreach(\App\Models\Album::where('user_id', optional(auth()->user())->id)->orderBy('id','DESC')->get() as $album)
                        <tr>
                            <td class="">
                                <a href="{{asset('album/'.$album->id)}}" class="text-amber-900 hover:underline">
                                {{$album->name}}
                                </a>
                            </td>
                            <td class="text-right">

                                @if($album->products->count()>0)
                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
                                        <div x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="m-2">
                                            Удалить
                                        </div>
                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                            <div class="absolute top-0 z-10 w-72 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-orange-500 rounded-lg shadow-lg">
                                                Эй! Этот альбом содержит изображения.
                                            </div>
                                            <svg class="absolute z-10 w-6 h-6 text-orange-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                                                <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                <a href="{{asset('album/'.$album->id.'/delete')}}" class="text-amber-900 hover:underline m-2">удалить</a>
                                @endif
                                    <a href="{{asset('album/'.$album->id.'/edit')}}" class="text-amber-900 hover:underline">редактировать</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
