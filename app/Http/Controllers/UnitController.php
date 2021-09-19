<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        return view('sales.units.index');
    }

    public function store(Request $request)
    {
        Unit::create($request->all());

        return redirect()->route('createItemUnits');
    }
}
