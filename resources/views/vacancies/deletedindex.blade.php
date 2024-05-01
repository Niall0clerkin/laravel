<x-app-layout>
<x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My deleted notes') }}
            </h2>
           
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-lg mb-4">All Your Deleted Vacancies</h3>
            @forelse ($deletedNotes as $note)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('vacancies.show', $note) }}">{{ $note->title }}</a>
                        <span class="block mt-6 text-sm ">Skills for job: {{$note->skills }} </span>
                    </h2>
                    <p class="mt-2">
                        <span><img src="{{ $note->image_path }}" width="160"></span>
                    </p>
                    <span class="block mt-6 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }} </span>
                <span class="block mt-4 text-sm opacity-70"> visits:{{$noteVisitCounts[$note->id] ?? 0}}</span>
                </div>
            @empty
                <p>You have no deleted notes.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
