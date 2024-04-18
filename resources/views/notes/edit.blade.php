<x-app-layout>

    <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

    {{ __('Edit Note') }}

    </h2>

    </x-slot>

    <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="pb-8">

    <p class="mb-2 bg-gray-300">We can take care of errors later</p>

    </div>

    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

    <form action="{{ route('notes.update', $note) }}" method="post">

    @csrf

    @method('PUT')

    <input

    type="text"

    name="title"

    field="title"

    class="w-full"

    autocomplete="off"

    value="{{ @old('title', $note->title) }}"">

    <textarea

    id="body"

    name="body"

    rows="10"

    field="text"

    class="w-full mt-6">{{ @old('body', $note->body) }}</textarea>

    <img src="{{ url($note->image_path) }}" alt="The stored image" width="500" id="image-preview">

    <p>Priority for this Note</p>

    <select name="priority"

    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

    <option value="1" @selected($note->priority == '1')>1</option>

    <option value="2" @selected($note->priority == '2')>2</option>

    <option value="3"@selected($note->priority == '3')>3</option>

    <option value="4" @selected($note->priority == '4')>4</option>

    <option value="5" @selected($note->priority == '5')>5</option>

    </select>

    <p>Category</p>
    <input type="text" name="category" placeholder="Type category here" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">


    <p>Estimated Time (in Minutes) to Read this Note</p>

    <select name="time_to_read"

    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

    <option value="1" @selected($note->time_to_read == '1')>1</option>

    <option value="2" @selected($note->time_to_read == '2')>2</option>

    <option value="5" @selected($note->time_to_read == '5')>5</option>

    <option value="10" @selected($note->time_to_read == '10')>10</option>

    </select>

    <label for="is_published" class="text-gray-500">

    Place in Viewable Set

    </label>

    <input

    type="checkbox"

    class=""

    name="is_published"

    {{ $note->is_published === 1 ? 'checked' : '' }}>

    <button class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">Update Note</button>

    </form>

    </div>

    </div>

    </div>

    </x-app-layout>
