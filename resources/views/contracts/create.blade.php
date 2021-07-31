<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Contract') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('saveContract') }}">
                        @csrf
            
                        <!-- Contract Year -->
                        <div>
                            <x-label for="year" :value="__('Year')" />
                            <x-input id="year" class="block mt-1 w-full" type="text" name="year" :value="old('year')" required autofocus />
                            @error('year')
                             <span class="mt-2 font-semibold text-xs text-red-500">{{ $message }}</span>
                             @enderror
                        </div>

                        <!-- Contract Year -->
                        <div class="mt-4">
                            <x-label for="contract_number" :value="__('Contract Number')" />
                            <x-input id="contract_number" class="block mt-1 w-full" type="text" name="contract_number" :value="old('contract_number')"  />
                            @error('contract_number')
                                <span class="mt-2 font-semibold text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Client -->
                        <div class="mt-4">
                          <select name="client_id" id="client">
                              @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->fullname }}</option>
                              @endforeach
                          </select>
                          <span class="text-xs text-gray-800">Or</span>
                          <a href="{{ route('createClient') }}" class="text-xs text-blue-600">Create New Client</a>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
