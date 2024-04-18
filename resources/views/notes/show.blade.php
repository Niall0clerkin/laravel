<x-app-layout>

    <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

    {{ __('Notes') }}

    </h2>

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

    <h2 class="font-bold text-4xl">

    {{ $note->title }}

    <!-- show.blade.php -->
<form action="{{ route('notes.destroy', $note->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn" style="background-color: red; color: white; border-radius: 12px;">   Delete Note   </button>
</form>



    </h2>

    <p class="mt-6 whitespace-pre-wrap">{{ $note->body }}</p>

    <div class="mt-2">

    <img src="{{ $note->image_path }}" alt="image url: {{ $note->image_path }}">

    </div>

    </div>

    </div>

    </div>

    </x-app-layout>
