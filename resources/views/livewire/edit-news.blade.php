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
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                            Изменить изображение из альбома
                        </label>
                        <select required
                                x-init="$store.ajaxNews.sender(@js(optional($article->picture)->album_id))"
                                class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                @change="$store.ajaxNews.sender($event.target.value)"
                        >
                            <option value="0">Выберите альбом</option>
                            @foreach($albums as $album)
                                <option
                                    value="{{$album->id}}" {{($album->id==optional($article->picture)->album_id)?'selected':''}}>{{$album->name}}
                                    ({{optional($album->products())->count()}})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="sub_radio"></div>

                    <div class="flex flex-col pt-5 pb-5">
                        <div wire:ignore>
                        <textarea wire:model="message"
                                  class="min-h-fit h-48"
                                  name="message"
                                  placeholder="Текст статьи"
                                  id="message">{!! optional($article->body)->body !!}</textarea>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="keywords">
                            Ключевые слова через запятую
                        </label>
                        <input type="text"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="keywords"
                               placeholder="Введите ключевые слова через запятую"
                               wire:model="keywords"/>
                    </div>
                    <button type="submit"
                            class="float-right p-2 ml-1  font-medium text-white text-center bg-sky-600 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Сохранить
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('ckeditor5/ckeditor.js')}}"></script>

    <script>
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open('POST', "{{
    route('upload', [
    '_token' => csrf_token(),
    'article_id' => $article->id
    ])}}", true);
                xhr.responseType = 'json';
            }

            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${file.name}.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }

                    resolve(response);
                });

                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            _sendRequest(file) {
                const data = new FormData();

                data.append('upload', file);

                this.xhr.send(data);
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#message'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('message', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
        document.addEventListener('livewire:init', () => {
            console.log('livewire donwnloaded');
        })
        document.addEventListener('alpine:init', () => {
            console.log('alpine donwnloaded');
            Alpine.store('ajaxNews', {
                sender(event_target_value = null) {
                    const subRadio = document.getElementById('sub_radio');
                    const cat = event_target_value;
                    const response = fetch('/ajax/album/' + cat)
                        .then((response) => response.text())
                        .then((text) => {
                            subRadio.innerHTML = text;
                        });
                }
            })
        })
    </script>
@endpush
