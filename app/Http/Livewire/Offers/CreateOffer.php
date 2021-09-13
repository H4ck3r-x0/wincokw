<?php

namespace App\Http\Livewire\Offers;

use Livewire\Component;
use App\Models\Client;

class CreateOffer extends Component
{
    public $clients = [];

    public function mount()
    {
        $this->clients = Client::all();
    }

    public function render()
    {
        return view('livewire.offers.create-offer');
    }
}
