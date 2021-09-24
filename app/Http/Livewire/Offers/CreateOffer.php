<?php

namespace App\Http\Livewire\Offers;


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
    public $OfferCreatedAt = null;
    public $offerExperationDate = null;
    public $totalPrice = 0;
    public $client_id = '';
    public $project_name = '';
    public $project_address = '';

    protected $rules = [
        'client_id' => 'required',
        'project_name' => 'required|min:6',
        'project_address' => 'required|min:6',
        'OfferCreatedAt' => 'required',
        'offerExperationDate' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount()
    {
        $this->clients = Client::all();
        $this->saleItems = SaleItem::all();
        $this->saleItemUnits = Unit::all();
        $this->OfferCreatedAt = Carbon::now()->format('Y-m-d');
        $this->offerExperationDate = Carbon::now()->addDays(15)->format('Y-m-d');
    }

    public function getTotalPrice()
    {
        $this->totalPrice = array_reduce(
            $this->offerProducts,
            function ($total, $item) {
                $itemPrice = (int)$item['item_price'];
                $discount = (int)$item['disc'];
                if ($discount && $discount > 0) {
                    $itemPrice = $itemPrice - $discount;
                    $total += $itemPrice * (int)$item['quantity'];
                } else {
                    $total += (int)$item['item_price'] * (int)$item['quantity'];
                }

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
        } else if ($key === $index . ".disc") {
            $this->offerProducts[$index]['disc'] = $value;
            $this->emit('getTotalPrice');
        } else if ($key === $index . ".quantity2") {
            $this->offerProducts[$index]['quantity2'] = $value;
            $this->emit('getTotalPrice');
        } else if ($key === $index . ".unit_id") {
            $this->offerProducts[$index]['unit_id'] = $value;
        } else if ($key === $index . ".unit2_id") {
            $this->offerProducts[$index]['unit2_id'] = $value;
        } else {
            $product = $this->saleItems->where('item_name', $value)->first();
            $this->offerProducts[$index]['id'] = $product->id;
            $this->offerProducts[$index]['unit_id'] = $product->unit_id;
            $this->offerProducts[$index]['unit2_id'] = $product->unit_id;
            $this->offerProducts[$index]['item_price'] = $product->item_price;
            $this->offerProducts[$index]['disc'] = 0;
            if ($this->offerProducts[$index]['item_price']) {
                $this->emit('getTotalPrice');
            }
        }
    }

    public function saveProduct()
    {
        dd('Saved!');
    }

    public function addProduct()
    {
        if (!empty($this->offerProducts)) {
            $this->offerProducts[] = [
                'id' => '',
                'item_name' => '',
                'unit_id' => '',
                'unit2_id' => '',
                'item_price' => '',
                'disc' => '',
                'quantity' => 1,
                'quantity2' => 0
            ];
        } else {
            $product = $this->saleItems->first();
            $this->offerProducts[] = [
                'id' => $product->id,
                'item_name' => $product->item_name,
                'unit_id' => $product->unit_id,
                'unit2_id' => $product->unit_id,
                'item_price' => $product->item_price,
                'disc' => 0,
                'quantity' => 1,
                'quantity2' => 0
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
