<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.Product-Brand.main');
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
        $validator = validator::make($request->all(),[
            'name' => 'required|unique:product_brands',
            'description' => 'max:225'
        ]);
        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors'   => $validator->errors()->all(),
                'class'    => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            $data = new ProductBrand;
            $data->name = $request->name;
            $data->description = $request->description;
            if($data->save())
            {
                $data = [
                    'response'  => 1,
                    'message'   => 'Product Brand added succesfully.',
                    'class'     => 'alert alert-success',
                ];
                return response()->json($data); 
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBrand $productBrand)
    {
        //
        $data = ProductBrand::orderBy('id', 'DESC')->get();
        return view('pages.Product-Brand.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBrand $productBrand, Request $request)
    {
        //
        $data = ProductBrand::where('id', $request->product_brand_id)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBrand $productBrand)
    {
        //
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'description' => 'max:225', 
        ]);
        $validator->after(function ($validator) {
            if (ProductBrand::where('id','!=' ,request('product_brand_id'))
                            ->where('name', request('name'))
                            ->exists()) {
                $validator->errors()->add('name', 'Name is already exists in record.');
            }
        }); 
        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors'   => $validator->errors()->all(),
                'class'    => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            $update = ProductBrand::where('id', $request->product_brand_id)
                                    ->update([
                                        'name' => $request->name,
                                        'description' => $request->description
                                    ]);
            if($update)
            {
                $data = [
                    'response' => 1,
                    'message'  => 'Product Brand Updated succesfully.',
                    'class'    => 'alert alert-success',
                ];
                return response()->json($data);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBrand $productBrand, Request $request)
    {
        //
        $delete = ProductBrand::where('id', $request->product_brand_id)->delete();
        if($delete)
        {
            $data = [
                'response' => 1,
                'message'  => 'Product Brand remove succesfully.',
                'class'    => 'alert alert-success', 
            ];
            return response()->json($data);

        }
        else
        {
            $data = [
                'response' => 0,
                'error'    => 'Oops Product Brand not remove succesfully. Please Try again',
                'class'    => 'alert alert-danger', 
            ];
            return response()->json($data);
        }
    }
}
