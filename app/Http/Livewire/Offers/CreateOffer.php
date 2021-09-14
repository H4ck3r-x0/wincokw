<?php

namespace App\Http\Livewire\Offers;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Client;

class CreateOffer extends Component
{
    public $clients = [];
    public $offerExperationDate = null;

    public function mount()
    {
        $this->clients = Client::all();
        $this->offerExperationDate = Carbon::now()->addDays(15)->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.offers.create-offer');
    }
}
