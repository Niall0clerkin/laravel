<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Button to create a new note -->
            <div class="mb-4">
                <a href="{{ route('vacancies.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create Vacancy</a>
            </div>

            <!-- List of notes -->
            @forelse ($notes as $note)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    <a href="{{ route('vacancies.show', $note) }}">{{ $note->title }}</a>
                </h2>
                <p class="mt-2">
                    <span><img src="{{ $note->image_path }}" width="160"></span>
                </p>
                <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
            </div>
            @empty
            <p>You have no notes yet.</p>
            @endforelse

            <!-- Pagination links -->
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
