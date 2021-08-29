<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class SaleCategoriesController extends Controller
{
    public function index()
    {
        $categories = ItemCategory::all();

        return view('sales.categories.index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:item_categories',
        ]);

        ItemCategory::create($request->all());
        
        return redirect()->route('createItemCategory');
    }

}
