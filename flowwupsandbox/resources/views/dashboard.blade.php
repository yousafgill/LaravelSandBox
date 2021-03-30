<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-0">
        <div class="max-w-full mx-auto sm:px-6 lg:px-0">
            <div class="bg-transparent overflow-hidden ">
                <!-- <x-jet-welcome /> -->
                @livewire('statsdashboard')
            </div>
        </div>
    </div>
</x-app-layout>