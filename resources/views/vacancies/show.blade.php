<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Notes') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <p class="opacity-70 sm:px-6">
                    <strong>Created: </strong> {{ $note->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $note->updated_at->diffForHumans() }}
                </p>
            </div>

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">{{ $note->title }}</h2>
                <p class="mt-6 whitespace-pre-wrap">{{ $note->body }}</p>

                <div class="flex items-center mb-4">
                    @if(Auth::id() === $note->user_id)
                        <form action="{{ route('vacancies.edit', $note->id) }}" method="get">
                            @csrf
                            <button type="submit" class="btn mr-4" style="background-color: #1a202c; color: white; padding: 8px 16px; border: 2px solid transparent; border-radius: 6px; font-size: 1rem; line-height: 1.5; text-align: center; vertical-align: middle; cursor: pointer;">Edit Note</button>
                        </form>
                        <form action="{{ route('vacancies.destroy', $note->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: red; color: white; padding: 8px 16px; border: 2px solid transparent; border-radius: 6px; font-size: 1rem; line-height: 1.5; text-align: center; vertical-align: middle; cursor: pointer;">Delete Note</button>
                        </form>
                    @endif
                </div>

                @foreach ($note->comments as $comment)
                    <div style="background-color: #f1f1f1; border-radius: 10px; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd;">
                        <div style="font-style: italic;">
                            <p>
                                Posted by: <span style="font-weight: bold;">{{ Auth::user()->name }}</span>
                                <span style="margin-left: 10px;">{{ $comment->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach

                <form action="{{ route('comments.store', $note) }}" method="post">
                    @csrf
                    <div style="background-color: #f1f1f1; border-radius: 10px; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd;">
                        <textarea name="content" rows="3" style="width: 100%; border-radius: 5px; border: 1px solid #ccc; padding: 5px;"></textarea>
                        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Add Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
