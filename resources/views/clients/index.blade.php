<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-row items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-3">
            {{ __('Clients') }}
        </h2>
        <form action="{{ route('allClients') }}" method="GET">
            @csrf
            <input type="text" name="search_clients" placeholder="Search">
        </form>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($clients as $client)
                        <div class="flex justify-between p-4 mb-6 shadow-md rounded-lg">
                            <div class="flex flex-col">
                                <h1 class="text-xl font-bold text-gray-900">{{ $client->fullname }}</h1>
                                <h3 class"text-sm">{{ $client->email }}</h3>
                                <span class="text-xs">{{ $client->phone }}</span>
                            </div>
                            <div>
                                <x-edit-button class="ml-3">
                                    {{ __('Edit') }}
                                </x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
