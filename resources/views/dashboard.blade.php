<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-dark overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-gray-700 text-white">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</x-app-layout>
