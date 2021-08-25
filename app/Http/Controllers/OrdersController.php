<?php

namespace App\Http\Controllers;
use App\Models\ContractOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $sortedOrders = ContractOrder::with('contract.user')->get();

        return view('ordersView.index', 
        [
            'sortedOrders' => $sortedOrders->sortByDesc('approval_date')->where('approval_date', '!==', null)
         ]);
    }
}
