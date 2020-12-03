<?php

namespace App\Http\Controllers;

use App\Models\ProductVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('pages.Product-Vendor.main');
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
        $Validator = Validator::make($request->all(), [
            'name'    => 'required',
            'contact' => 'required|unique:product_vendors',
            'email'   => 'nullable|unique:product_Vendors',
            'address' => 'nullable|max:225',

        ]);
        if($Validator->fails())
        {
            $data = [
                'response' => 0,
                'errors'   => $Validator->errors()->all(),
                'class'    => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            $data = new ProductVendor;
            $data->name = $request->name;
            $data->contact = $request->contact;
            $data->email   = $request->email;
            $data->address = $request->address;
            if($data->save())
            {
                $data = [
                    'response' => 1,
                    'message'  => 'Product Vendor add successfully.',
                    'class'    => 'alert alert-success',

                ];
                return response()->json($data);
            }
        }
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVendor $productVendor)
    {
        //
        $data = ProductVendor::OrderBy('id', 'DESC')->get();
        return view('pages.Product-Vendor.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVendor $productVendor, Request $request)
    {
        //

        $data = ProductVendor::where('id', $request->product_vendor_id)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVendor $productVendor)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'contact' => 'required',
            'email'    => 'nullable|email',
            'address'  => 'nullable|max:255', 
        ]);
        $validator->after(function ($validator) {
            if (ProductVendor::where('id','!=' ,request('product_vendor_id'))
                            ->where('contact', request('contact'))
                            ->exists()) {
                $validator->errors()->add('contact', 'Contact No is already exists in record.');
            }
            
        }); 
        $validator->after(function ($validator) {
            if(request('email') != '')
            {
                if (ProductVendor::where('id','!=' ,request('product_vendor_id'))
                                ->where('email', request('email'))
                                ->exists()) {
                    $validator->errors()->add('contact', 'Email address is already exists in record.');
                }
            }
        }); 
        if($validator->fails()){
            $data = [
                'response' => 0,
                'errors'   => $validator->errors()->all(),
                'class'    => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            $update = ProductVendor::where('id', $request->product_vendor_id)
                                    ->update([
                                        'name' => $request->name,
                                        'contact' => $request->contact,
                                        'address' => $request->address,
                                        'email'   => $request->email
                                    ]);
            if($update)
            {
                $data = [
                    'response' => 1,
                    'message'  => 'Product Vendor Updated Successfully.',
                    'class'    => 'alert alert-success',
                ];
                return response()->json($data);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVendor $productVendor, Request $request)
    {
        //
        // return response()->json($request->all());
        $delete = ProductVendor::where('id', $request->product_vendor_id)->delete();
        if($delete)
        {
            $data = [
                'response' => 1,
                'message'  => 'Product Vendor delete successfully.',
                'class'    => 'alert alert-success',
            ];
            return response()->json($data);
        }
    }
}
