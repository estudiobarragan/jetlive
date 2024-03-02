<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div class="flex-none mt-4 mr-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('SPA') }}
                </h2>
            </div>
            <div class="flex-initial">
                @persist('player')
                    <audio src="{{ asset('audios/07 - Seek You Out.mp3') }}" controls invisible></audio>
                @endpersist
            </div>
        </div>
    </x-slot>
 </x-app-layout>