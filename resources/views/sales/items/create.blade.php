<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Create Sales Items") }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-00">
                    <form method="POST" action="{{ route('saveSalesItem') }}">
                    @csrf

                        <!-- Item name -->
                        <div>
                            <x-label for="item_name" :value="__('Item Name')" />
                            <x-input id="item_name" class="block mt-1 w-full" type="text" name="item_name" :value="old('item_name')" required autofocus placeholder="Item Name" />
                        </div>

                        <div class="flex flex-row justify-between">
                            <!-- Item Category -->
                            <div class="mt-3">
                                    <x-label for="item_categories_id" :value="__('Category Name')" />
                                    <select name="item_categories_id" id="item_categories_id" class="mt-1">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- Item Unit -->
                                <div class="mt-3">
                                    <x-label for="me_unit" :value="__('Item Unit')" />
                                    <select name="me_unit" id="me_unit" class="mt-1">
                                        <option value="M2">M2</option>                         
                                        <option value="L">L</option>                         
                                        <option value="piece">piece</option>                         
                                    </select>
                                </div>

                                <!-- Item Unit 2 -->
                                <div class="mt-3">
                                    <x-label for="me_unit_sec" :value="__('Unit 2')" />
                                    <select name="me_unit_sec" id="me_unit_sec" class="mt-1">
                                        <option value="M3">M3</option>                         
                                        <option value="L">L</option>                         
                                        <option value="piece">piece</option>                         
                                    </select>
                                </div>                            
                        </div>

                        <!-- Item name -->
                        <div class="mt-1">
                            <x-label for="item_price" :value="__('Item Price')" />
                            <x-input id="item_price" class="block mt-1 w-full" type="text" name="item_price" :value="old('name')" required autofocus placeholder="Item Price" />
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
                                    #
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
                                    Item Name
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
                                    Item Unit
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
                                    Item Unit 2
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
                                    Item Price
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
                                    Category
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
                                    Created at
                                </th>
                            </tr>
                        </thead>
                    <tbody class="bg-white  divide-gray-200">
                        @foreach($items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->id }}
                                    </div>
                                </td>
                            
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->item_name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->me_unit }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->me_unit_sec }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->item_price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</x-app-layout>
