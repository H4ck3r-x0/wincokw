<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use App\Models\Unit;
use App\Models\ItemCategory;
use Illuminate\Http\Request;


class SalesItemController extends Controller
{
    public function create()
    {
        $categories = ItemCategory::all();
        $units = Unit::all();
        $items = SaleItem::with(['category', 'units'])->get();
        return view('sales.items.create', ['categories' => $categories, 'items' => $items, 'units' => $units]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_categories_id' => 'required',
            'unit_id' => 'required',
            'item_price' => 'required',
        ]);

        SaleItem::create($request->all());

        return redirect()->route('createItem');
    }

    public function destroy($item)
    {
        SaleItem::destroy($item);
        return redirect()->route('createItem');
    }
}
