<?php

namespace App\Http\Controllers\PenarikanBarang;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildRequest;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChildRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildRequest $request)
    {

        $request->validate();

        // Get ppb_id yang terbaru
        $ppb_id = DB::connection('mysql2')
        ->table('ppb_header')
        ->select('ppb_id')
        ->latest('created_at')
        ->first();

        $data_child = new Child();
        $data_child->ppb_id = $ppb_id;
        $data_child->ppb_item_qty = $request->ppb_item_qty;
        $data_child->ppb_item_pn = $request->ppb_item_pn;
        $data_child->ppb_item_desc = $request->ppb_item_desc;
        $data_child->ppb_item_currency = $request->ppb_item_currency;
        $data_child->ppb_item_price = $request->ppb_item_price;
        $data_child->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
