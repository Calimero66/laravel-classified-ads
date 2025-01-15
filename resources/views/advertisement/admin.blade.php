@extends('layouts.app')

@section('title', 'My advertisements')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @forelse ($ads as $ad)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <a href="{{ route('advertisement.show', $ad->id) }}">
                    <img src="{{ $ad->image_url }}" class="w-full h-32 object-cover">
                </a>
                <p class="text-right text-gray-600 px-3 py-2 text-sm">{{ $ad->price }} &euro;</p>

                <form class="p-3 flex justify-center space-x-2" method="post"
                    action="{{ route('advertisement.destroy', $ad->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('advertisement.edit', $ad->id) }}"
                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Edit
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Delete
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                You have no advertisements.
            </div>
        @endforelse
    </div>
</div>
@endsection