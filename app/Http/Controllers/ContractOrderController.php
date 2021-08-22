<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\OrderPurchase;
use App\Models\ContractOrder;
use App\Models\OrderSent;
use App\Models\OrderProduction;
use App\Models\OrderDistortion;

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
        $order = ContractOrder::with('contract')->findOrFail($order_id);
        $order_sent = OrderSent::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $order_purchases = OrderPurchase::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $order_production = OrderProduction::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $order_distortion = OrderDistortion::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();

        return view('orders.show', 
        [
            'order' => $order, 
            'order_sent' => $order_sent,
            'order_purchases' => $order_purchases,
            'order_production' => $order_production,
            'order_distortion' => $order_distortion,
            'orderSentDiff' => $this->orderSentDiff($order_sent),
            'orderPurchasesDiff' => $this->orderPurchasesDiff($order_purchases),
            'orderProductionDiff' => $this->orderProductionDiff($order_production)
        ]);
    }

    protected function orderSentDiff($order_sent)
    {
        $orderSentStartTime = Carbon::parse($order_sent->order_scheduled);
        $orderSentEndTime = Carbon::parse($order_sent->actual);

        if($order_sent->actual) {
           return $orderSentEndTime->diffInDays($orderSentStartTime, false);
        } else {
            return 'N/A';
        }
    }

    protected function orderPurchasesDiff($order_purchases)
    {
        $orderPurchasesStartTime = Carbon::parse($order_purchases->purchase_scheduled);
        $orderPurchasesEndTime = Carbon::parse($order_purchases->actual);
        if($order_purchases->actual) {
            return $orderPurchasesEndTime->diffInDays($orderPurchasesStartTime, false);
        } else {
            return 'N/A';
        }
    }

    protected function orderProductionDiff($order_production)
    {
        $orderProductionScheduledAt = Carbon::parse($order_production->production_scheduled);
        $orderProductionActual = $order_production->actual ? Carbon::parse($order_production->actual) : null;
        $orderProductionExpected = $order_production->expected ? Carbon::parse($order_production->expected) : null;
        
        if(isset($orderProductionActual)) {
            return  $orderProductionActual->diffInDays($orderProductionScheduledAt, false);
        } else if(isset($orderProductionExpected)) {
            return  $orderProductionScheduledAt->diffInDays($orderProductionExpected, false);
        } else {
            return 'N/A';
        }
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
        $orderPurchase->purchase_scheduled = Carbon::parse($request->approval_date)->addDays(10)->format('Y-m-d');
        $orderPurchase->save();

        $OrderProduction = OrderProduction::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $OrderProduction->production_scheduled = Carbon::parse($request->approval_date)->addDays(15)->format('Y-m-d');
        $OrderProduction->save();

        return redirect()->back();
    }

    /**
     * Update actual date for order Technical Study
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrderSentActualDate(Request $request, $contract_id, $order_id)
    {
        $orderSent = OrderSent::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $orderSent->actual = $request->actual;
        $orderSent->save();
        return redirect()->back();
    }

    /**
     * Update actual date for order Purchases
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrderPurchasesActualDate(Request $request, $contract_id, $order_id)
    {
        $orderPurchase = orderPurchase::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $orderPurchase->actual = $request->actual;
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
        $this->orderProduction($contract_id, $contractOrder);
        $this->OrderDistortion($contract_id, $contractOrder);

        return redirect()->back();
    }


    /**
     * Update productiin started date for order Production
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrderProductionStartedDate(Request $request, $contract_id, $order_id)
    {

        $OrderProduction = OrderProduction::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $OrderProduction->production_starts = $request->production_starts;
        $OrderProduction->expected = Carbon::create($request->production_starts)->addDays(15);
        $OrderProduction->save();
        return redirect()->back();
    }

    /**
     * Update productiin actual date for order Production
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrderProductionActualDate(Request $request, $contract_id, $order_id)
    {
        $OrderProduction = OrderProduction::where(['contract_id' => $contract_id, 'contract_order_id' => $order_id])->first();
        $OrderProduction->actual = $request->actual;
        $OrderProduction->save();
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

        // Create order production date 
        protected function orderProduction($contract_id, $contractOrder)
        {
            OrderProduction::create([
                'production_scheduled' => Carbon::now()->addDays(15),
                'contract_id' => $contract_id,
                'contract_order_id' => $contractOrder
            ]);
        }

        // Create order distortion date 
        protected function OrderDistortion($contract_id, $contractOrder)
        {
            OrderDistortion::create([
                'order_dist_scheduled' => Carbon::now()->addDays(20),
                'contract_id' => $contract_id,
                'contract_order_id' => $contractOrder
            ]);
        }
}
