<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Create Items Units") }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-00">
                    <form method="POST" action="{{ route('saveItemUnits') }}">
                        @csrf
                        <!-- Item unit name -->
                        <div>
                            <x-label for="name" :value="__('Unit Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Unit Name" />
                        </div>
                        <x-button class="mt-3">
                            {{ __('Save') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-00">
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
                                    #
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
                                    Unit Name
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
                                    Created at
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
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white  divide-gray-200">
                            @foreach($units as $unit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $unit->id }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $unit->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $unit->created_at->diffForHumans() }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <form action="{{ route('destroyItemUnit', $unit->id) }}" method="POST">
                                            @csrf
                                            <x-delete-button class="ml-3">
                                                {{ __("Delete") }}
                                            </x-delete-button>
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