<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAttandance;
use App\Http\Requests\StoreMonthlyAttandanceRequest;
use App\Http\Requests\UpdateMonthlyAttandanceRequest;

class MonthlyAttandanceController extends Controller
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
     * @param  \App\Http\Requests\StoreMonthlyAttandanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMonthlyAttandanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthlyAttandance  $monthlyAttandance
     * @return \Illuminate\Http\Response
     */
    public function show(MonthlyAttandance $monthlyAttandance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthlyAttandance  $monthlyAttandance
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthlyAttandance $monthlyAttandance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMonthlyAttandanceRequest  $request
     * @param  \App\Models\MonthlyAttandance  $monthlyAttandance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMonthlyAttandanceRequest $request, MonthlyAttandance $monthlyAttandance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthlyAttandance  $monthlyAttandance
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyAttandance $monthlyAttandance)
    {
        //
    }
}
