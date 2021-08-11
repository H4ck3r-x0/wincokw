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
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $order->year }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ $order->contract->contract_number }}
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
                    href="#"
                    >Send Order</a
                >
            </td>
        </tr>
    </tbody>
</table>
