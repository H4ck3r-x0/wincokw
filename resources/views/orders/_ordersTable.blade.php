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
                Actions
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
            ></th>
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
            <td
                x-data="{ open: false }"
                class="px-6 py-4 whitespace-nowrap cursor-pointer"
                @click="open = true"
            >
                <span
                    x-show="!open"
                    >{{ $order->approval_date ? $order->approval_date : 'N/A' }}</span
                >
                @if($order->approval_date !== null)
                <form
                    action="{{ route('updateOrderApprovalDate', [$contractOrders->id, $order->id]) }}"
                    x-show="open"
                    method="POST"
                >
                    @csrf
                    <input
                        type="date"
                        name="approval_date"
                        value="{{ $order->approval_date }}"
                    />
                    <button type="submit">Save</button>
                </form>

                @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $order->delivery_date ? $order->delivery_date : 'N/A' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <a
                    class="
                        inline-flex
                        items-center
                        px-1
                        pt-1
                        border-b-2 border-transparent
                        text-sm
                        font-medium
                        leading-5
                        text-gray-500
                        hover:text-gray-700 hover:border-gray-300
                        focus:outline-none
                        focus:text-gray-700
                        focus:border-gray-300
                        transition
                        duration-150
                        ease-in-out
                    "
                    href="{{ route('orderDetails', [$contractOrders->id, $order->id]) }}"
                    >Details</a
                >
            </td>
            <td>
                <form
                    action="{{ route('deleteOrder', $order->id) }}"
                    method="POST"
                >
                    @csrf
                    <x-delete-button>Delete</x-delete-button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
