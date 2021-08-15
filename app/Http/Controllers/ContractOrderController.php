<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\OrderPurchase;
use App\Models\ContractOrder;
use App\Models\OrderSent;

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
            'order_number' => 'required|unique:contract_orders',
        ]);
        
        ContractOrder::create([
            'year' =>  Carbon::now()->format('Y'),
            'order_number' => $request->order_number,
            'contract_id' => $contract_id,
        ]);
        
        return redirect()->back();
    }
    
    /**
     * Show a single order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($contract_id, $order_id)
    {   
        return view('orders.show', 
        [
        'order' => ContractOrder::with('contract')->findOrFail($order_id), 
        'order_sent' => OrderSent::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])
        ->first(),
        'order_purchases' => OrderPurchase::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])
        ->first()
        ]);
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id)
    {   
        ContractOrder::destroy($order_id);
      
        return redirect()->back();
    }

 /**
     * Update approval date for order 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrderApprovalDate(Request $request, $contract_id, $order_id)
    {   
        $order = ContractOrder::find($order_id);
        $order->approval_date = $request->approval_date;
        $order->delivery_date = Carbon::parse($request->approval_date)->addDays(60)->format('Y-m-d');
        $order->contract_id = $contract_id;
        $order->save();

        $orderSent = OrderSent::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $orderSent->order_scheduled = Carbon::parse($request->approval_date)->addDays(5)->format('Y-m-d');
        $orderSent->save();
      
        $orderPurchase = orderPurchase::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $orderPurchase->purchase_scheduled = Carbon::parse($request->approval_date)->addDays(5)->format('Y-m-d');
        $orderPurchase->save();


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

        $this->orderSent($contract_id, $contractOrder);
        $this->orderPurchase($contract_id, $contractOrder);

        return redirect()->back();
    }
    
    // Create order sent date
    protected function orderSent($contract_id, $contractOrder)
    {
        OrderSent::create([
            'order_scheduled' => Carbon::now()->addDays(5),
            'contract_id' => $contract_id,
            'contract_order_id' => $contractOrder
        ]);
    }

     
    // Create order sent date
    protected function orderPurchase($contract_id, $contractOrder)
    {
        OrderPurchase::create([
            'purchase_scheduled' => Carbon::now()->addDays(10),
            'contract_id' => $contract_id,
            'contract_order_id' => $contractOrder
        ]);
    }
}
