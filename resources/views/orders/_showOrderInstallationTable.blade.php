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
            Install Scheduled At
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
        Installation Started At
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
           Install End Date
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
                            {{ $order_installation->install_scheduled ? $order_installation->install_scheduled : 'N/A' }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                <div class="text-sm text-gray-900 cursor-pointer" @click="open = true">
                    <span x-show="!open">{{ $order_installation->install_starts ? $order_installation->install_starts : 'N/A' }}</span>
                    @if($order_distortion->actual)
                    <form action="{{ route('updateOrderInstallStartedDate', [$order_installation->contract_id, $order_installation->contract_order_id]) }}" method="POST" x-show="open">
                        @csrf
                        <input type="date" name="install_starts" id="install_starts" value="{{ $order_installation->install_starts }}">
                        <button type="submit">Save</button>
                    </form>
                    @endif
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                <div class="text-sm text-gray-900 cursor-pointer" @click="open = true">
                    <span x-show="!open">{{ $order_installation->actual ? $order_installation->actual : 'N/A' }}</span>
                    @if($order_distortion->actual)
                    <form action="{{ route('updateOrderInstallActualDate', [$order_installation->contract_id, $order_installation->contract_order_id]) }}" method="POST" x-show="open">
                        @csrf
                        <input type="date" name="actual" id="actual" value="{{ $order_installation->actual }}">
                        <button type="submit">Save</button>
                    </form>
                    @endif
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" >
                <div class="text-sm text-gray-900 cursor-pointer" @click="open = true">
                   {{ $order_installation->expected ? $order_installation->expected : 'N/A' }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap {{ $orderInstallDiff < 0 ? 'bg-red-400 text-white font-semibold' : 'bg-green-400 text-white font-semibold' }}">
                {{ $orderInstallDiff }}
            </td>
        </tr>
    </tbody>
</table>
