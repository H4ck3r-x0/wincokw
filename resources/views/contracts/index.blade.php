<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-3">
                {{ __("Contracts") }}
            </h2>
            <form action="{{ route('allContracts') }}" method="GET">
                @csrf
                <input
                    type="text"
                    name="search_contracts"
                    placeholder="Search .."
                    required
                />
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3">
                <a href="{{ route('allContracts') }}">All Contracts</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-00">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    "
                                >
                                    Client Name
                                </th>
                                <th
                                scope="col"
                                class="
                                    px-6
                                    py-3
                                    text-left text-xs
                                    font-medium
                                    text-gray-500
                                    uppercase
                                    tracking-wider
                                "
                            >
                                Client Phone Number
                            </th>
                                <th
                                    scope="col"
                                    class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    "
                                >
                                    Contract Number
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    "
                                >actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($contracts as $contract)
                            <tr>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            {{ $contract->client->fullname }}
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            {{ $contract->client->phone }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $contract->contract_number }}
                                    </div>
                                </td>

                             
                                <td>
                                    <div class="flex flex-row">
                                        <form
                                            action="{{ route('deleteContract', $contract->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            <x-delete-button class="ml-3">
                                                {{ __("Delete") }}
                                            </x-delete-button>
                                        </form>
                                        <form
                                            action="{{ route('contractOrders', $contract->id) }}"
                                            method="GET"
                                        >
                                            @csrf
                                            <x-approve-button class="ml-3">
                                                {{ __("Orders") }}
                                            </x-approve-button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <div class="flex flex-col justify-center items-center">
                                <h1 class="text-center text-lg">No Contracts found</h1>
                                <a
                                    href="{{ route('createContract') }}"
                                    class="text-md text-blue-600"
                                    >Create</a
                                >
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


