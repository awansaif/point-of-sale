<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::orderBy('id', 'DESC')->get();
        return view('pages.Product.update-stock',compact('data'));
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
        // return response()->json($request->product);
        $validator = Validator::make($request->all(),[
            'product.*'       => 'required',
            'stock.*'         => 'required',
            'cost_per_item.*' => 'required',
            'sale_price.*'    => 'required|gte:cost_per_item.*' 
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
            for($i = 0; $i < count($request->product);  $i++)
            {
                $check = Product::where('id', $request->product[$i])->first();
                $update = Product::where('id', $request->product[$i])
                                    ->update([
                                        'stock' => $check->stock + $request->stock[$i],
                                        'cost_per_item' => $request->cost_per_item[$i],
                                        'inventory_worth' => ($check->stock + $request->stock[$i]) *  ($request->cost_per_item[$i]),
                                        'sale_price'      => $request->sale_price[$i]
                                    ]);
            }
            if($update)
            {
                $data = [
                    'response' => 1,
                    'message'  => 'Data daved successfully',
                    'class'    => 'alert alert-success',
                ];
                return response()->json($data);
            }
        }
        // return response()->json($request->all());
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
