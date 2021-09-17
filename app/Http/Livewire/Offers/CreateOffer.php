<?php

namespace App\Http\Livewire\Offers;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SaleItem;
use App\Models\Client;

class CreateOffer extends Component
{
    public $offerProducts = [];
    public $clients = [];
    public $saleItems = [];
    public $saleItemUnits = [];
    public $offerExperationDate = null;
    public $addMoreProducts = false;

    public function mount()
    {
        $this->clients = Client::all();
        $this->saleItems = SaleItem::all();
        $this->saleItemUnits = ['M2', 'L', 'peice', 'M3'];
        $this->offerExperationDate = Carbon::now()->addDays(15)->format('Y-m-d');
    }

    public function addProduct()
    {
        if ($this->offerProducts > 0) {
            $this->offerProducts[] = [
                'item_id' => '',
                'item_name' => '',
                'me_unit' => '',
                'item_price' => '',
                'quantity' => 1
            ];
        } else {
            $product = $this->saleItems->first();
            $this->offerProducts[] = [
                'item_id' => $product->id,
                'item_name' => $product->item_name,
                'me_unit' => $product->me_unit,
                'item_price' => $product->item_price,
                'quantity' => 1
            ];
        }
    }

    public function productChanged($product_index)
    {
        dd($product_index);
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
