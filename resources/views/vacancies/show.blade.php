<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Note Details') }}
        </h2>
    </x-slot>




    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">





            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <div class="flex items-center mb-4">
                    @if(Auth::id() === $note->user_id)
                        <form action="{{ route('vacancies.edit', $note->id) }}" method="get">
                            @csrf
                            <button type="submit" class="btn mr-4" style="background-color: #1a202c; color: white; padding: 8px 16px; border: 2px solid transparent; border-radius: 6px; font-size: 1rem; line-height: 1.5; text-align: center; vertical-align: middle; cursor: pointer;">Edit Note</button>
                        </form>

                    @endif
                @if ($isDeleted)
                    <form method="POST" action="{{ route('vacancies.reupload', $note->id) }}">
                        @csrf
                        <button type="submit" class="btn mr-4" style="background-color: #028dff; color: white; padding: 8px 16px; border: 2px solid transparent; border-radius: 6px; font-size: 1rem; line-height: 1.5; text-align: center; vertical-align: middle; cursor: pointer;">Reupload</button>
                    </form>
                @endif
            </div>

                <h2 class="font-bold text-2xl">{{ $note->title }}</h2>
                <p class="mt-2">
                    <span><img src="{{ $note->image_path }}" width="160"></span>
                </p>
                <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
            </div>



    </div>
</x-app-layout>
