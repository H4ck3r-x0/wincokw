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
    public $offerProducts = [];
    public $clients = [];
    public $saleItems = [];
    public $saleItemUnits = [];
    public $offerExperationDate = null;


    public function mount()
    {
        $this->clients = Client::all();
        $this->saleItems = SaleItem::all();
        $this->saleItemUnits = Unit::all();;
        $this->offerExperationDate = Carbon::now()->addDays(15)->format('Y-m-d');
    }


    public function updatedOfferProducts($value, $key)
    {
        $index = substr($key, 0, 1);
        if ($key === substr($key, 0, 1) . ".item_price") {
            $this->offerProducts[$index]['item_price'] = $value;
        } else if ($key === substr($key, 0, 1) . ".quantity") {
            $this->offerProducts[$index]['quantity'] = $value;
        } else if ($key === substr($key, 0, 1) . ".unit_id") {
            $this->offerProducts[$index]['unit_id'] = $value;
        } else {
            $product = $this->saleItems->where('item_name', $value)->first();
            $key = substr($key, 0, 1);
            $this->offerProducts[$key]['unit_id'] = $product->unit_id;
            $this->offerProducts[$key]['item_price'] = $product->item_price;
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
        }
    }

    public function productChanged($product_index)
    {
    }

    public function showProducts()
    {
        dd($this->offerProducts);
    }

    public function removeProduct($index)
    {
        unset($this->offerProducts[$index]);
        $this->offerProducts = array_values($this->offerProducts);
    }

    public function render()
    {
        return view('livewire.offers.create-offer');
    }
}
