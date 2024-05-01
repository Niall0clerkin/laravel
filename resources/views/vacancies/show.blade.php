<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancy Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
            <div class="flex items-center mb-4">
                <h2 class="font-bold text-2xl flex-grow">{{ $note->title }}</h2>
               
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
                @else
                    @if ($note->user_id === Auth::id())
                        <form action="{{ route('vacancies.destroy', $note->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn mr-4" style="background-color: #ff0000; color: black; padding: 8px 16px; border: 2px solid transparent; border-radius: 6px; font-size: 1rem; line-height: 1.5; text-align: center; vertical-align: middle; cursor: pointer;">Delete</button>
                        </form>
                    @endif
                @endif
            </div>

    <div class="mb-4">
        @if (Str::startsWith($note->image_path, 'data:image'))
            <img src="{{ $note->image_path }}" alt="Note Image">
        @else
            <img src="{{ asset($note->image_path) }}" alt="Note Image">
        @endif
    </div>

    <div class="mb-4">
        <p><strong>Skills:</strong> {{ $note->skills }}</p>
    </div>

    <div class="mb-4">
        <p>{{ $note->body }}</p>
    </div>

    <div class="mb-4">
        <p><strong>Priority:</strong> {{ $note->priority }}</p>
    </div>

    <div class="mb-4">
        <p><strong>Category:</strong> {{ $note->category }}</p>
    </div>

    <div class="mb-4">
        <p><strong>Estimated Time:</strong> {{ $note->time_to_read }} minutes</p>
    </div>

    

    
</div>
                
                <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
                <!-- Comments section -->
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h3 class="font-bold text-xl mb-4">Comments  @guest
                    <div class="flex">
                    <a href="{{ route('login') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mr-4">Login</a>
                    </div>
                    @endguest</h3>
                    
                    
                    <!-- Check if there are any comments -->
                    @if ($note->comments->count() > 0)
                        <!-- Display existing comments -->
                        @foreach ($note->comments as $comment)
                            <div class="border border-gray-300 rounded p-4 mb-4">
                            <p class="font-semibold">Posted by {{ $comment->user->name }}</p>
                                <p>{{ $comment->content }}</p>
                                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                <!-- Delete comment form for the comment owner -->
                               @if (auth()->user()->is_superuser)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn mr-4" style="background-color: #ff0000; color: black; padding: 8px 16px; border: 2px solid transparent; border-radius: 6px; font-size: 1rem; line-height: 1.5; text-align: center; vertical-align: middle; cursor: pointer;">Delete comment</button>
                                    </form>
                                @endif 
                            </div>
                        @endforeach
                    
                    
                    
                        @else
                        <p>No comments yet.</p>
                    @endif

                    <!-- Form to add a new comment -->
                   @auth

                   
                        <!-- Error message for empty comment -->
                        @if ($errors->any())
                            <div class="flashmessage alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300 my-5 mb-4">
                                <div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                                    <span class="text-red-500">
                                        <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                                           
                                        </svg>
                                    </span>
                                </div>
                                <div class="alert-content ml-4">
                                    <div class="alert-title font-semibold text-lg text-red-800">
                                        {{ __('Whoops, something went wrong!') }}
                                    </div>
                                    <div class="alert-description text-sm text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    <form action="{{ route('comments.store', $note->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <textarea name="content" class="w-full border-gray-300 rounded-md" placeholder="Add a comment"></textarea>
                        </div>
                       


                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Comment</button>
                    </form>
                   @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
