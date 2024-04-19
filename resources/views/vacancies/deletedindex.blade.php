<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deleted Vacancies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-lg mb-4">All Your Deleted Vacancies</h3>
            @forelse ($deletedNotes as $note)
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
                <p>You have no deleted notes.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
