<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index()
    {
        return view('invoices.offers.index');
    }
}
