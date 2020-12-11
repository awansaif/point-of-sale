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
        $data = [
            'types'   => ProductType::orderBy('id', 'DESC')->get(),
            'brands'  => ProductBrand::orderBy('id', 'DESC')->get(),
            'vendors' => ProductVendor::orderBy('id', 'DESC')->get(), 
        ];
        return view('pages.Product.main',compact('data'));
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
            if($request->file('product_pic'))
            {
                $file = $request->file('product_pic');
                $destinationPath = 'product-pics';
                $file_name = time().$file->getClientOriginalName();
                $check = $file->move($destinationPath,$file_name);
                if($check)
                {
                    $data = new Product;
                    $data->product_pic = 'product-pics/'. $file_name;
                    $data->name        = $request->name;
                    $data->type        = $request->type;
                    $data->brand       = $request->brand;
                    $data->stock       = $request->stock;
                    $data->cost_per_item    = $request->cost_per_item;
                    $data->inventory_worth  = $request->stock * $request->cost_per_item;
                    $data->vendor      = $request->vendor;
                    $check = $data->save();   
                }
            }
            else
            {
                $data = new Product;
                $data->product_pic = 'https://image.shutterstock.com/image-illustration/set-colorful-empty-shopping-bags-260nw-691305127.jpg';
                $data->name        = $request->name;
                $data->type        = $request->type;
                $data->brand       = $request->brand;
                $data->stock       = $request->stock;
                $data->cost_per_item    = $request->cost_per_item;
                $data->inventory_worth  = $request->stock * $request->cost_per_item;
                $data->vendor      = $request->vendor;
                $check = $data->save();
            }
            
            if($check)
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
    public function edit(Product $product, Request $request)
    {
        //
        $data = Product::where('id', $request->product_id)->first();
        return response()->json($data);
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
        $validator = Validator::make($request->all(),[
            'product_id' =>  'required',
            'name'       =>  'required',
            'type'       =>  'required',
            'brand'      =>  'required',
            'stock'      =>  'required',
            'cost_per_item'    => 'required',
            'inventory_worth'  => 'required',
            'vendor'           => 'required',
        ]);
        $validator->after(function ($validator) {
            if (Product::where('id','!=' ,request('product_id'))
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
                'class'    => 'alert alert-danger' 
            ];
            return response()->json($data);

        }
        else
        {
            if($request->file('product_pic'))
            {
                $file = $request->file('product_pic');
                $destinationPath = 'product-pics';
                $file_name = time().$file->getClientOriginalName();
                $check = $file->move($destinationPath,$file_name);
                if($check)
                {
                    $update = Product::where('id', $request->product_id)
                                ->update([
                                    'product_pic' => 'product-pics/'. $file_name,
                                    'name' => $request->name,
                                    'type' => $request->type,
                                    'brand'=> $request->brand,
                                    'stock'=> $request->stock,
                                    'cost_per_item' => $request->cost_per_item,
                                    'inventory_worth' => $request->stock * $request->cost_per_item,
                                    'vendor'=> $request->vendor,
                                ]);
                }
            }
            else
            {
                $update = Product::where('id', $request->product_id)
                                ->update([
                                    'name' => $request->name,
                                    'type' => $request->type,
                                    'brand'=> $request->brand,
                                    'stock'=> $request->stock,
                                    'cost_per_item' => $request->cost_per_item,
                                    'inventory_worth' => $request->stock * $request->cost_per_item,
                                    'vendor'=> $request->vendor,
                                ]);
            }
            if($update)
            {
                $data = [
                    'response' => 1,
                    'message' => 'Product Update successfully',
                    'class'   => 'alert alert-success',
                ];
                return response()->json($data);
            }
        }
        // return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        //
        $delete = Product::where('id', $request->product_id)->delete();
        if($delete)
        {
            $data = [
                'response' => 1,
                'message'  => 'Product removed successfully',
                'class'    => 'alert alert-success',
            ];
            return response()->json($data);
        }
    }
}
