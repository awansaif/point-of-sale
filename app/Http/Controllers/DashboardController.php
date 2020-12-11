<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class DashboardController extends Controller
{
    //
	public function index()
	{
		$data = [
			'short-items' => Product::with('brands', 'vendors')
								->where('stock', '<', 80)->count(),
		];
		return view('dashboard',compact('data'));
	}
    public function show_items()
    {
    	$data = Product::orderBy('id', 'DESC')->where('stock', '<', 50)->get();
    	return view('pages.Dashboard-pages.short-items',compact('data'));
    }
}
