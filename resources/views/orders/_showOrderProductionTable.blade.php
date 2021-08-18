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
            Production Scheduled At
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
        Production Started At
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
            Actual Date
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
        Expected
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
            Difference
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $order_production->production_scheduled ? $order_production->production_scheduled : 'N/A' }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                <div class="text-sm text-gray-900 cursor-pointer" @click="open = true">
                    <span x-show="!open">{{ $order_production->production_starts ? $order_production->production_starts : 'N/A' }}</span>
                    <form action="{{ route('updateOrderProductionStartedDate', [$order_production->contract_id, $order_production->contract_order_id]) }}" method="POST" x-show="open">
                        @csrf
                        <input type="date" name="production_starts" id="production_starts" value="{{ $order_production->production_starts }}">
                        <button type="submit">Save</button>
                    </form>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                <div class="text-sm text-gray-900 cursor-pointer" @click="open = true">
                    <span x-show="!open">{{ $order_production->actual ? $order_production->actual : 'N/A' }}</span>
                    <form action="{{ route('updateOrderProductionActualDate', [$order_production->contract_id, $order_production->contract_order_id]) }}" method="POST" x-show="open">
                        @csrf
                        <input type="date" name="actual" id="actual" value="{{ $order_production->actual }}">
                        <button type="submit">Save</button>
                    </form>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                <div class="text-sm text-gray-900 cursor-pointer" @click="open = true">
                    <span x-show="!open">{{ $order_production->expected ? $order_production->expected : 'N/A' }}</span>
                    <form action="{{ route('updateOrderProductionExpectedDate', [$order_production->contract_id, $order_production->contract_order_id]) }}" method="POST" x-show="open">
                        @csrf
                        <input type="date" name="expected" id="expected" value="{{ $order_production->expected }}">
                        <button type="submit">Save</button>
                    </form>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap {{ $orderPurchasesDiff < 0 ? 'bg-red-400 text-white font-semibold' : 'bg-green-400 text-white font-semibold' }}">
                {{ $orderPurchasesDiff }}
            </td>
        </tr>
    </tbody>
</table>
