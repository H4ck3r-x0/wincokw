<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use App\Models\ItemCategory;
use Illuminate\Http\Request;


class SalesItemController extends Controller
{
    public function create()
    {
        $categories = ItemCategory::all();
        $items = SaleItem::with('category')->get();
  
        return view('sales.items.create', ['categories' => $categories, 'items' => $items]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_categories_id' => 'required',
            'me_unit' => 'required',
            'me_unit_sec' => 'required',
            'item_price' => 'required',
        ]);

        SaleItem::create($request->all());

        return redirect()->route('createItem');

    }
}
