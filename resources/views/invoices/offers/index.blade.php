<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Quotations') }}
            </h2>
            <x-button>Create</x-button>
        </div>
    </x-slot>

</x-app-layout>