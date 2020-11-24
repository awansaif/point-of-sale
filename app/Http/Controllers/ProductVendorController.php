<?php

namespace App\Http\Controllers;

use App\Models\ProductVender;
use Illuminate\Http\Request;

class ProductVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages/product-vendors');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVender  $productVender
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVender $productVender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVender  $productVender
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVender $productVender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVender  $productVender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVender $productVender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVender  $productVender
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVender $productVender)
    {
        //
    }
}
