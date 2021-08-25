<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\Client;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search_contracts)
        {
            $contracts = Contract::whereHas('client', function($query) use ($request) {
                $query->where('fullname', 'like', "%{$request->search_contracts}%");
            })->get();
        } else {
            $contracts = Contract::with(['client'])->get();
        }

        return view('contracts.index', ['contracts' => $contracts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients =  Client::all();
        return view('contracts.create', ['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'contract_number' => 'required|unique:contracts',
        ]);
        
        $request->request->add(['user_id' => $request->user()->id]);
        Contract::create($request->all());
        
        return redirect()->route('allContracts');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        Contract::destroy($contract->id);
        return redirect()->back();
    }
}
