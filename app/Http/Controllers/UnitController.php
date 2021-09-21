<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('sales.units.index', ['units' => $units]);
    }

    public function store(Request $request)
    {
        Unit::create($request->all());

        return redirect()->route('createItemUnits');
    }


    public function destroy(Unit $unit)
    {
        Unit::destroy($unit->id);

        return redirect()->route('createItemUnits');
    }
}
