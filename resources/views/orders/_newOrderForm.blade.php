<form action="{{ route('saveOrder', $contractOrders->id) }}" method="POST">
    @csrf
    <div class="flex flex-col">
        <div class="flex">
            <x-input id="email" class="mr-2 " type="text" name="order_number" placeholder="Order Number" value="{{ old('order_number') }}"  required autofocus />
            <x-button>
                {{ __("Add") }}
            </x-button>
        </div>
        <div class="mt-3">
        @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="font-semibold text-sm text-red-400">{{ $error }}</li>
                    @endforeach
                </ul>
        @endif
        </div>
    </div>
</form>
