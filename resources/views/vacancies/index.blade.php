<x-app-layout>
<x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Job vacancies') }}
            </h2>
            <form action="{{ route('vacancies.index') }}" method="GET" class="flex items-center">
                <select name="category" class="w-40 block mr-4 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-md shadow-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <button type="submit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Filter</button>
            </form>
        </div>
    </x-slot>
   
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Button to create a new note -->
            @auth
            <div class="mb-4">
                <a href="{{ route('vacancies.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create Vacancy</a>
            </div>
            @endauth


            <!-- List of notes -->
            @forelse ($notes as $note)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    <a href="{{ route('vacancies.show', $note) }}">{{ $note->title }}</a>
                    <span class="block mt-6 text-sm ">Skills for job: {{$note->skills }} </span>
                </h2>
                <p class="mt-2">
                    <span><img src="{{ $note->image_path }}" width="160"></span>
                </p>
                <span class="block mt-6 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }} </span>
                <span class="block mt-4 text-sm opacity-70"> visits:{{ $noteVisitCounts[$note->id] ?? 0 }}</span>
             
            </div>
            @empty
            <p>You have no notes yet.</p>
            @endforelse

            <!-- Pagination links -->
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
