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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-00">
                    @forelse ($contracts as $contract)
                    <div
                        class="
                            relative
                            flex
                            justify-between
                            p-4
                            mb-6
                            shadow-md
                            rounded-lg
                            {{ $contract->approval_date === null ? '' : 'border-b-4 border-green-400' }}
                        "
                    >
                        <div class="flex flex-col">
                            <h1 class="text-xl font-bold text-gray-900">
                                {{ $contract->client->fullname }}
                            </h1>
                            <h3 class="text-sm font-semibold">
                                Contract Number:
                                <span
                                    class="text-gray-600"
                                    >{{ $contract->contract_number }}</span
                                >
                            </h3>
                        </div>
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
                    </div>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
