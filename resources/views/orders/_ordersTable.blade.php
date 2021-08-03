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
                Approve Order
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
                Year
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
            >
                Order Number
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
                Approval Date
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
                Delivery Date
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($contractOrders->orders as $order)

        <tr class="{{ $order->approval_date !== null ? 'bg-green-50' : '' }}">
            <td class="whitespace-nowrap">
                <div class="flex items-center">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            <form
                                action="{{ route('approveContract', [$contractOrders->id, $order->id]) }}"
                                method="POST"
                            >
                                @csrf @if($order->approval_date === null)
                                <x-approve-button>Approve</x-approve-button>
                                @else
                                <x-approve-button disabled
                                    >Approved</x-approve-button
                                >
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $order->year }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ $contractOrders->contract_number }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $order->order_number }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $order->approval_date ? $order->approval_date : 'N/A' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $order->delivery_date ? $order->delivery_date : 'N/A' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
