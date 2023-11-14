<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex flex-row">
                <form method="post" wire:submit="save" class="w-full">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Название статьи
                        </label>
                        <input type="text"
                               required
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="name"
                               placeholder="Введите название"

                               wire:model="name"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                            Короткое описание
                        </label>
                        <textarea
                            required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="body"

                            wire:model="description"
                        ></textarea>
                    </div>
                    <div class="flex flex-col space-y-10">
                        <div wire:ignore>
                        <textarea wire:model="message"
                                  class="min-h-fit h-48"
                                  name="message"
                                  placeholder="Текст статьи"
                                  id="message"></textarea>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                            Добавить изображение из альбома
                        </label>
                        <select required
                                class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                @change="
const subRadio = document.getElementById('sub_radio');
const cat = $event.target.value;
                            const response = await fetch('/ajax/album/'+cat)
                            .then((response) => response.text())
                            .then((text) => {
                              subRadio.innerHTML = text;
                            });
            "
                        >
                            <option>Выберите альбом</option>
                            @foreach($albums as $album)
                                <option value="{{$album->id}}">{{$album->name}}
                                    ({{optional($album->products())->count()}})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="sub_radio"></div>
                    <button type="submit"
                            class="float-right p-2 ml-1  font-medium text-white text-center bg-sky-600 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Сохранить
                    </button>
                </form>
            </div>
            <div>
                @foreach($articles as $article)
                    <div class="p-2 hover:text-sky-800">
                        {{$article->name}}
                        <div class="float-right">
                            <a href="{{asset('my_news/'.$article->id.'/edit')}}" class="text-sky-400 hover:underline p-2">Редактировать</a>
                        </div>
                    </div>
                @endforeach
                <div class="items-center">
                    {!! $articles->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#message'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('message', editor.getData())
                    ;
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush

