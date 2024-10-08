<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-3">
                {{ __('Clients') }}
            </h2>
            <form action="{{ route('allClients') }}" method="GET">
                @csrf
                <input type="text" name="search_clients" placeholder="Search" required>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2">
                <a href="{{ route('allClients') }}">All Clients</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">
                                    #id
                                </th>
                                <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">
                                    name
                                </th>
                                <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">
                                    email
                                </th>
                                <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">
                                    Phone Number
                                </th>
                                <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clients as $client)
                            <tr>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            {{ $client->id }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900" @click="open = true" x-show="!open">
                                                {{ $client->fullname }}
                                            </div>
                                            <div class="text-sm font-medium text-gray-900" x-show="open">
                                                <form action="{{ route('updateClient', $client->id) }}" method="POST">
                                                    @csrf
                                                    <input type="text" name="fullname" value={{ $client->fullname }} />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                                    <div class="text-sm text-gray-900" @click="open = true" x-show="!open">
                                        {{ $client->email }}
                                    </div>

                                    <div class="text-sm font-medium text-gray-900" x-show="open">
                                        <form action="{{ route('updateClient', $client->id) }}" method="POST">
                                            @csrf
                                            <input type="text" name="email" value={{ $client->email }} />
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                                    <div class="text-sm text-gray-900" @click="open = true" x-show="!open">
                                        {{ $client->phone }}
                                    </div>
                                    <div class="text-sm font-medium text-gray-900" x-show="open">
                                        <form action="{{ route('updateClient', $client->id) }}" method="POST">
                                            @csrf
                                            <input type="text" name="phone" value={{ $client->phone }} />
                                        </form>
                                    </div>
                                </td>

                                <td class="px-2 py-2 whitespace-nowrap">
                                    <div class="flex flex-row">
                                        <form action="{{ route('createOffer', $client->id) }}" method="GET" class="mr-2">
                                            @csrf
                                            <x-approve-button>New Offer</x-approve-button>
                                        </form>
                                        <form action="{{ route('destroyClient', $client->id) }}" method="POST">
                                            @csrf
                                            <x-delete-button>Delete</x-delete-button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>