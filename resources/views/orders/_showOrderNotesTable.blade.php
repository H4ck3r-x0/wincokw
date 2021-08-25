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
            Notes Scheduled At
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
            Difference
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $order_notes ? $order_notes->order_note_scheduled : 'N/A' }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }" @click.away="open = false">
                <div class="text-sm text-gray-900 cursor-pointer" @click="open = true">
                    <span x-show="!open">{{ $order_notes->actual ? $order_notes->actual : 'N/A' }}</span>
                    @if($order_installation->install_starts || $order_installation->actual)
                    <form action="{{ route('updateOrderNoteActualDate', [$order_notes->contract_id, $order->id]) }}" method="POST" x-show="open">
                        @csrf
                        <input type="date" name="actual" id="actual" value="{{ $order_notes->actual }}">
                        <button type="submit">Save</button>
                    </form>
                    @endif
                </div>
            </td>
            <td 
            class="px-6 py-4 whitespace-nowrap {{ $orderNoteDiff < 0 ? 'bg-red-400 text-white font-semibold' : 'bg-green-400 text-white font-semibold' }}">
                {{ $orderNoteDiff }}
            </td>
        </tr>
    </tbody>
</table>
