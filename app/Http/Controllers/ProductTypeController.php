<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product_types = ProductType::orderBy('id', 'DESC')->get();
        $last_update_time = ProductType::select('updated_at')->latest()->first();
        $date = Carbon::parse($last_update_time['updated_at']);  
        $data = [
            'product_types' => $product_types,
            'last_update_time' => $date->isoFormat('MMMM Do YYYY, h:mm:ss a'), 
        ];
        return view('pages.product-types',compact('data'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_types',
            'description' => 'required',
        ]);
        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors' => $validator->errors()->all(),
                'class' => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            $data = new ProductType;
            $data->name = $request->name;
            $data->description = $request->description;
            if($data->save())
            {
                $data = [
                    'response' => 1,
                    'message'  => 'Product Type save successfully.',
                    'class'    => 'alert alert-success',
                ];
                return response()->json($data);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType, Request $request)
    {
        //
        $product_type_data = ProductType::where('id', $request->product_id)->first();
        return response()->json($product_type_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        //
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'description' => 'required', 
        ]);
        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors' => $validator->errors()->all(),
                'class'  => 'alert alert-danger'
            ];
        }
        else
        {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}
