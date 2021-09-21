<?php

namespace App\Http\Livewire\Offers;

use Illuminate\Support\Arr;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\SaleItem;
use App\Models\Client;
use App\Models\Unit;


class CreateOffer extends Component
{
    protected $listeners = ['getTotalPrice' => 'getTotalPrice'];
    public $offerProducts = [];
    public $clients = [];
    public $saleItems = [];
    public $saleItemUnits = [];
    public $offerExperationDate = null;
    public $totalPrice = 0;

    public function mount()
    {
        $this->clients = Client::all();
        $this->saleItems = SaleItem::all();
        $this->saleItemUnits = Unit::all();
        $this->offerExperationDate = Carbon::now()->addDays(15)->format('Y-m-d');
    }

    public function getTotalPrice()
    {
        $this->totalPrice = array_reduce(
            $this->offerProducts,
            function ($total, $item) {
                $total += (int)$item['item_price'] * (int)$item['quantity'];

                return $total;
            },
            0
        );
    }

    public function updatedOfferProducts($value, $key)
    {
        $index = substr($key, 0, 1);
        if ($key === $index . ".item_price") {
            $this->offerProducts[$index]['item_price'] = $value;
            $this->emit('getTotalPrice');
        } else if ($key === $index . ".quantity") {
            $this->offerProducts[$index]['quantity'] = $value;
            $this->emit('getTotalPrice');
        } else if ($key === $index . ".unit_id") {
            $this->offerProducts[$index]['unit_id'] = $value;
        } else {
            $product = $this->saleItems->where('item_name', $value)->first();
            $this->offerProducts[$index]['id'] = $product->id;
            $this->offerProducts[$index]['unit_id'] = $product->unit_id;
            $this->offerProducts[$index]['item_price'] = $product->item_price;
            if ($this->offerProducts[$index]['item_price']) {
                $this->emit('getTotalPrice');
            }
        }
    }

    public function addProduct()
    {
        if (!empty($this->offerProducts)) {
            $this->offerProducts[] = [
                'id' => '',
                'item_name' => '',
                'unit_id' => '',
                'item_price' => '',
                'quantity' => 1
            ];
        } else {
            $product = $this->saleItems->first();
            $this->offerProducts[] = [
                'id' => $product->id,
                'item_name' => $product->item_name,
                'unit_id' => $product->unit_id,
                'item_price' => $product->item_price,
                'quantity' => 1
            ];
            $this->emit('getTotalPrice');
        }
    }

    public function showProducts()
    {
        dd($this->offerProducts);
    }

    public function removeProduct($index)
    {
        unset($this->offerProducts[$index]);
        $this->offerProducts = array_values($this->offerProducts);
        $this->emit('getTotalPrice');
    }

    public function render()
    {
        return view('livewire.offers.create-offer');
    }
}
