<div>
    <header class="bg-white shadowbg-white shadow">
        <div class=" max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-row items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-3">
                    {{ __("Create Quotations") }}
                </h2>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">

                        <!-- Client -->
                        <div class="w-full mr-4">
                            <x-label for="client" :value="__('Client Name')" />
                            <select name="client_id" id="client" class="w-full">
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->fullname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Offer Created at -->
                        <div class="mr-3">
                            <x-label for="OfferCreatedAt" :value="__('Offer Created At')" />
                            <input type="date" name="OfferCreatedAt" id="OfferCreatedAt" value="{{ $OfferCreatedAt }}" wire:model="OfferCreatedAt" class="{{ $errors->has('OfferCreatedAt') ? 'border border-red-500' : '' }}">
                        </div>

                        <!-- Offer Expration Date -->
                        <div>
                            <x-label for="offer_exp" :value="__('Offer Expires')" />
                            <input type="date" name="offer_exp" id="offer_exp" value="{{ $offerExperationDate }}" class="{{ $errors->has('offerExperationDate') ? 'border border-red-500' : '' }}">
                        </div>
                    </div>

                    <!-- Project Name -->
                    <div class="mt-3">
                        <x-label for="project_name" :value="__('Project Name')" />
                        <x-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" wire:model="project_name" :value="old('project_name')" placeholder="Project Name" required />
                        @error('project_name') <span class="text-xs font-semibold text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <!-- Project Adress -->
                    <div class="mt-3">
                        <x-label for="project_address" :value="__('Project Address')" />
                        <x-input id="project_address" class="block mt-1 w-full" type="text" name="project_address" wire:model="project_address" :value="old('project_address')" placeholder="Project Address" required />
                        @error('project_address') <span class="text-xs font-semibold text-red-400">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button type="button" wire:click.prevent="addProduct">+ Add Product</x-button>
            <x-button type="button" wire:click.prevent="showProducts">Show Products</x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-00">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">Item Name</th>
                            <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">Unit</th>
                            <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">Quantity</th>
                            <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">Unit 2</th>

                            <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">Quantity</th>
                            <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">Item Price</th>
                            <th scope="col" class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    ">Disc</th>
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
                            @foreach ($offerProducts as $index => $offerProduct)
                            <tr>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <!-- Products Name -->
                                            <div>
                                                <select name="offerProducts[{{$index}}][item_name]" wire:model="offerProducts.{{$index}}.item_name">
                                                    <option value="">Choose an item</option>
                                                    @foreach($saleItems as $product)
                                                    <option value="{{ $product->item_name}}">
                                                        {{ $product->item_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <!-- Product unit -->
                                            <div class="">
                                                <select name="offerProducts[{{$index}}][unit_id]" wire:model="offerProducts.{{$index}}.unit_id">
                                                    @foreach($saleItemUnits as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class=" whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <!-- Products QTY -->
                                            <div class="mr-4">
                                                <input name="offerProducts[{{$index}}][quantity]" wire:model="offerProducts.{{$index}}.quantity" value="offerProducts[{{$index}}][quantity]" type="number" min="1" size="5">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <!-- Product unit -->
                                            <div class="">
                                                <select name="offerProducts[{{$index}}][unit2_id]" wire:model="offerProducts.{{$index}}.unit2_id">
                                                    @foreach($saleItemUnits as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class=" whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <!-- Products QTY -->
                                            <div class="mr-4">
                                                <input name="offerProducts[{{$index}}][quantity2]" wire:model="offerProducts.{{$index}}.quantity2" value="offerProducts[{{$index}}][quantity2]" type="number" min="0" size="5">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <!-- Item Price -->
                                            <div class="mr-4">
                                                <input type="text" size="2" name="offerProducts[{{$index}}][item_price]" value="{{ $offerProducts[$index]['item_price'] }}" wire:model="offerProducts.{{$index}}.item_price">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <!-- Item Price -->
                                            <div class="mr-4">
                                                <input type="text" size="2" name="offerProducts[{{$index}}][disc]" value="{{ $offerProducts[$index]['disc'] }}" wire:model="offerProducts.{{$index}}.disc">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <x-button wire:click.prevent="removeProduct({{$index}})">X</x-button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <td class="whitespace-nowrap">
                                    Total Price
                                </td>
                                <td wire:model="totalPrice">{{ $totalPrice }}</td>
                            </tr>
                        </tfoot> -->
                    </table>

                    <!-- Calculation -->
                    <div class="mt-6">
                        <h1 class="font-semibold text-xl text-gray-500 ">Amount</h1>
                        <div class="flex items-center ">
                            <label for="total" class="font-semibild text-gray-600 text-lg mr-2">Total:</label>
                            <h1 id="total" wire:model="totalPrice">{{ $totalPrice }}</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>