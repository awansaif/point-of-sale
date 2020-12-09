<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductType;
use App\Models\ProductVendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('pages.Product.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'types'   => ProductType::orderBy('id', 'DESC')->get(),
            'brands'  => ProductBrand::orderBy('id', 'DESC')->get(),
            'vendors' => ProductVendor::orderBy('id', 'DESC')->get(), 
        ];
        return view('pages.Product.create',compact('data'));
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
        $validator = Validator::make($request->all(), [
            'product_pic' => 'nullable|image',
            'name'        => 'required|unique:products',
            'type'        => 'required',
            'brand'       =>  'required',
            'stock'       =>  'required|numeric',
            'cost_per_item'   => 'required|numeric',
            'inventory_worth' => 'required|numeric',
            'vendor'          => 'nullable',
            ]);
        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors'   => $validator->errors()->all(),
                'class'    => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            $data = new Product;
            $data->product_pic = $request->product_pic;
            $data->name        = $request->name;
            $data->type        = $request->type;
            $data->brand       = $request->brand;
            $data->stock       = $request->stock;
            $data->cost_per_item    = $request->cost_per_item;
            $data->inventory_worth  = $request->stock * $request->cost_per_item;
            $data->vendor      = $request->vendor;
            if($data->save())
            {
                $data = [
                    'message' => 'Product add successfully',
                    'class'   => 'alert alert-success',

                ];
                return response()->json($data);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        $data = Product::with('types','brands', 'vendors')
                        ->orderBy('id', 'DESC')->get();
        return view('pages.Product.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
