<form action="{{ route('saveOrder', $contractOrders->id) }}" method="POST">
    @csrf
    <div>
        <x-input id="email" class="" type="text" name="order_number" placeholder="Order Number"  required autofocus />
        <x-button>
            {{ __("Add") }}
        </x-button>
    </div>
</form>
