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

                    <!-- Offer Expration Date -->
                    <div>
                        <x-label for="offer_exp" :value="__('Offer Expires')" />
                        <input type="date" name="offer_exp" id="offer_exp" value="{{ $offerExperationDate }}">
                    </div>
                </div>

                <!-- Project Name -->
                <div class="mt-3">
                    <x-label for="project_name" :value="__('Project Name')" />
                    <x-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" :value="old('project_name')" placeholder="Project Name" required />
                </div>

                <!-- Project Adress -->
                <div class="mt-3">
                    <x-label for="project_address" :value="__('Project Address')" />
                    <x-input id="project_address" class="block mt-1 w-full" type="text" name="project_address" :value="old('project_address')" placeholder="Project Address" required />
                </div>

            </div>
        </div>
    </div>
</div>


<div x-data="handler()">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-button type="button" @click="addNewField()">+ Add Product</x-button>
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
                                    ">Prodect Name</th>

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
                        <template x-for="(field, index) in fields" :key="index">
                            <tr>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <input x-model="field.txt1" type="text" name="txt1[]" class="form-control">

                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <x-button type="button" @click="removeField(index)">X</x-button>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function handler() {
        return {
            fields: [],
            addNewField() {
                this.fields.push({
                    txt1: '',
                    txt2: ''
                });
            },
            removeField(index) {
                this.fields.splice(index, 1);
            }
        }
    }
</script>