<?php

namespace App\Http\Livewire\Offers;

use Livewire\Component;

class OffersIndex extends Component
{
    public $show = false;

    public function render()
    {
        return view('livewire.offers.offers-index');
    }
}
