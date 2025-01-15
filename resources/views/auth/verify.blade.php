@php
    use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-lg sm:p-8">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="py-4 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <h2 class="text-2xl font-bold mb-4 text-gray-900">
                            {{ __('Verify Your Email Address') }}
                        </h2>

                        @if (session('resent'))
                            <div class="rounded-md bg-green-50 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <p class="text-gray-600 mb-4">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                        </p>
                        
                        <div class="flex items-center">
                            <span class="text-gray-600">{{ __('If you did not receive the email') }},</span>
                            <form class="inline-block ml-1" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" 
                                    class="text-indigo-600 hover:text-indigo-500 font-medium focus:outline-none focus:underline transition ease-in-out duration-150">
                                    {{ __('click here to request another') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection