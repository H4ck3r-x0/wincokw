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
                Created By
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
                created at
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
                updated by
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
                updated at
            </th>
   
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $orderCreatedBy->name }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ $orderActivityCreated->created_at->diffForHumans() }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $orderUpdatedBy->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
        
                {{ $orderActivityUpdated->updated_at->diffForHumans() }}
            </td>
      
        </tr>
    </tbody>
</table>
