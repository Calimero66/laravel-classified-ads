@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Route;
@endphp

@section('title', 'Classifieds Board')

@section('content')
<div class="bg-white shadow">
    <nav class="px-4 py-2">
        <ul class="flex space-x-4">
            <li
                class="{{ Route::currentRouteName() == 'advertisement.index' ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }}">
                <a href="{{ route('advertisement.index') }}">All</a>
            </li>
            <li>
                <form method="GET" action="{{ route('advertisement.index') }}" class="inline">
                    <input type="text" name="search" placeholder="Search categories..."
                        class="border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring focus:ring-indigo-300"
                        value="{{ request('search') }}">
                    <button type="submit" class="text-indigo-600 font-semibold ml-2">Search</button>
                </form>
            </li>
        </ul>
    </nav>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($ads as $ad)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <a href="{{ route('advertisement.show', $ad->id) }}">
                    <img src="{{ $ad->image_url }}" alt="Advertisement image" class="w-full h-48 object-cover">
                </a>
                <p class="text-right text-gray-600 p-3 text-sm">{{ $ad->price }} &euro;</p>
            </div>
        @endforeach
    </div>
</div>

<div class="mt-6 flex justify-center">
    {{ $ads->links() }}
</div>
@endsection