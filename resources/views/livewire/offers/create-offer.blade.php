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
                <!-- Client -->
                <div class="mt-4">
                    <label>Client</label>
                    <select name="client_id" id="client">
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->fullname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>