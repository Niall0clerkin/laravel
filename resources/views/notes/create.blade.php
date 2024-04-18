<x-app-layout>

    <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

    {{ __('Notes') }}

    </h2>

    </x-slot>

    <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="pb-8">

    <p class="mb-2 bg-gray-300">We can take care of errors later</p>

    </div>

    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

    <form action="{{ route('notes.store') }}" method="post">

    @csrf

    <input

    type="text"

    name="title"

    field="title"

    placeholder="Title"

    class="w-full"

    autocomplete="off"

    value="{{ @old('title') }}"">

    <textarea

    id="body"

    name="body"

    rows="10"

    field="text"

    placeholder="Start typing your note here..."

    class="w-full mt-6">{{ @old('body') }}</textarea>

    <p>Priority for this Note</p>

    <select name="priority"

    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

    <option value="1">1</option>

    <option value="2" selected>2</option>

    <option value="3">3</option>

    <option value="4">4</option>

    <option value="5">5</option>

    </select>

    <p>Category</p>
    <input type="text" name="category" placeholder="Type category here" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">


    <p>Estimated Time (in Minutes) to Read this Note</p>

    <select name="time_to_read"

    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

    <option value="1">1</option>

    <option value="2" selected>2</option>

    <option value="5">5</option>

    <option value="10">10</option>

    </select>

    <label for="is_published" class="text-gray-500">

    Place in Viewable Set

    </label>

    <input

    type="checkbox"

    class=""

    name="is_published"

    checked>


    <div class="mx-auto sm:px-6 lg:px-8">

    <button class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save Note</button>

    </div>
    </form>
    </div>
    </div>
    </div>

    </x-app-layout>
