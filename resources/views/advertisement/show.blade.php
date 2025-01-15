@extends('layouts.app')

@section('title', 'Advertisement: ' . $ad->id)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        @auth
            @if (auth()->user()->id === $ad->user_id)
                <div class="p-4 bg-gray-50 border-b">
                    <form class="flex justify-end space-x-4" method="post"
                        action="{{ route('advertisement.destroy', $ad->id) }}">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('advertisement.edit', $ad->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div class="w-full">
                <img src="{{ $ad->image_url }}" alt="Advertisement image"
                    class="w-full h-auto rounded-lg shadow-sm object-cover">
            </div>

            <div class="space-y-4">
                <div class="space-y-2">
                    <p class="text-gray-700">
                        <span class="font-semibold">Posted by:</span>
                        {{ $ad->user ? $ad->user->name : 'Unknown' }}
                    </p>

                    <p class="text-gray-700"><span class="font-semibold">ID:</span> {{ $ad->id }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Category:</span> {{ $ad->category->title }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Price:</span> {{ $ad->price }} &euro;</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Description:</h3>
                    <p class="text-gray-600">{{ $ad->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection