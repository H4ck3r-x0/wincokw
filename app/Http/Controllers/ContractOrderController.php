<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\ContractOrder;

class ContractOrderController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contract_id)
    {
        $contractOrders = Contract::where('id', $contract_id)
        ->with(['orders'])
        ->first();

        return view('orders.index', ['contractOrders' => $contractOrders]);
    }


    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $contract_id)
    {
        $request->validate([
            'order_number' => 'required',
        ]);
        
        ContractOrder::create([
            'year' =>  Carbon::now()->format('Y'),
            'order_number' => $request->order_number,
            'contract_id' => $contract_id,
        ]);
        
        return redirect()->back();
    }


    /**
     * Approve Contract date.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
    */
    public function approve($contract_id,  $contractOrder)
    {
        $order = ContractOrder::find($contractOrder);
        $order->contract_id = $contract_id;
        $order->approval_date = Carbon::now();
        $order->delivery_date = Carbon::now()->addDays(60);
        $order->save();
        return redirect()->back();
    }    
}
