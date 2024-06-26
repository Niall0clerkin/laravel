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
                <form action="{{ route('vacancies.update', $note) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <p>Title</p>

                    <input type="text" name="title" field="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off" value="{{ @old('title', $note->title) }}">

                    <p>Skills</p>
                    <input
                        type="text"
                        name="skills"
                        placeholder="Enter skills"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        autocomplete="off"
                        value="{{ old('skills') }}"
                    >

                    <p>About role</p>
                    <textarea id="body" name="body" rows="10" field="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ @old('body', $note->body) }}</textarea>

                    <p>Priority for this Note</p>
                    <select name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1" @selected($note->priority == '1')>1</option>
                        <option value="2" @selected($note->priority == '2')>2</option>
                        <option value="3" @selected($note->priority == '3')>3</option>
                        <option value="4" @selected($note->priority == '4')>4</option>
                        <option value="5" @selected($note->priority == '5')>5</option>
                    </select>

                    <p>Category</p>
                    <input type="text" name="category" placeholder="Type category here" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <p>Estimated Time (in Minutes) to Read this Note</p>
                    <select name="time_to_read" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1" @selected($note->time_to_read == '1')>1</option>
                        <option value="2" @selected($note->time_to_read == '2')>2</option>
                        <option value="5" @selected($note->time_to_read == '5')>5</option>
                        <option value="10" @selected($note->time_to_read == '10')>10</option>
                    </select>

                    <p>Upload Image</p>
                    <input type="file" name="image" accept="image/*">

                    <button class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Update Note</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>