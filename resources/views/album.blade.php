<x-app-layout>

    <div class=" p-2 ml-1 text-center text-lg">
        {{$album->name}}
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 ">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
                        <div class="w-full p-1">
                            @if(auth()->guest())
                                <div>Чтобы добавить изображение, необходима авторизация
                                    <a href="{{asset('login')}}" class="text-blue-900 underline hover:no-underline font-bold">Login</a>
                                    <a href="{{asset('register')}}" class="text-blue-900 underline hover:no-underline font-bold">Register</a>
                                </div>
                            @else
                                <div
                                    x-data="{ 'showModal': false }"
                                    @keydown.escape="showModal = false"
                                >
                                    <!-- Trigger for Modal -->
                                    <button type="button" @click="showModal = true" class="p-2 w-full block font-medium text-gray-900 text-center bg-blue-300 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-200 rounded-lg dark:bg-blue-300 dark:hover:bg-blue-700 dark:focus:ring-blue-400">Добавить</button>

                                    <!-- Fon -->
                                    <div
                                        class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                        x-show="showModal"
                                    >
                                        <!-- Modal inner -->
                                        <div
                                            class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                                            @click.away="showModal = false"
                                        >

                                            <div class="w-full max-w-xs">
                                                <form class="bg-white roundedmb-4" action="{{asset('album/'.$album->id.'/product_add')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                                            Название
                                                        </label>
                                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Название фото">
                                                    </div>
                                                    <div class="mb-4">
                                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture1" name="picture1" type="file" placeholder="picture">
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                        <button class="bg-blue-700 hover:bg-blue-500 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                            Добавить
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                       @include('includes.product')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
