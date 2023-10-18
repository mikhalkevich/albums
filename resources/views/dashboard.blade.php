<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex flex-row">
                    <form method="post" action="{{asset('album')}}">
                        @csrf
                        <label for="name">
                            <span>Album name</span>
                            <input name="name" id="name" />
                        </label>
                        <br />
                        <label for="body">
                            <span>Description</span>
                            <textarea name="body" id="body" ></textarea>
                        </label>
                        <button type="submit" class="p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
