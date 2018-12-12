<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Exception;
use Log;
use Config;
use Auth;


class ProductController extends Controller
{
    public function __construct() 
    {
        //$this->objProduct = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(Config::get('app.default_paginate'));
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        return view('products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {

            $product = new Product;
            $data = [];
            $data = $request->all();
            $data['created_by'] = Auth::id();
            $data['sku'] = CommonHelper::generateRandomNo(Config::get('app.default_sku_length'));

            //Required validation checked and let's save new product records.
            $product->fill($data)->save();
            
            return redirect()->route('products.index')->with('success', app('translator')->getFromJson('Product successfully created.'));

        } catch (Exception $e) {
            //Save error into the log
            Log::error($e);
            return redirect()->back()->withInput($request->input())->with("error", app('translator')->getFromJson('Something went wrong.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $request, $id)
    {
        try {
            
            $product = Product::findOrFail(Crypt::decrypt($id));
            return view('products.edit', compact('product'));

        } catch (Exception $e) {
            //Save error into the log
            Log::error($e);
            return redirect()->back()->with("error", app('translator')->getFromJson('Product not found.'));
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            
            $product = Product::findOrFail(Crypt::decrypt($id));
            $product->title = e($request->title);
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->content = e($request->content);
            $product->save();
            return redirect()->route('products.index')->with('success', app('translator')->getFromJson('Product successfully updated.'));

        } catch (Exception $e) {
            //Save error into the log
            Log::error($e);
            return redirect()->back()->with("error", app('translator')->getFromJson('Product not found.'));
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail(Crypt::decrypt($id));
            $product->delete();
            return response()->json(["result" => true, "status" => 200, "message" => app('translator')->getFromJson('Product deleted successfully.')]);
        } catch (Exception $e) {
            //Save error into the log
            Log::error($e);
            return response()->json(["result" => false, "status" => $e->getCode(), "message" => app('translator')->getFromJson('Something went wrong.')]);
        }
    }

    /**
     * Search the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $orderBy = ($request->order_by != "" && in_array(strtolower($request->order_by), ["asc", "desc"])) ? $request->order_by : "asc";
            $searchOn = ($request->search_on != "" && in_array(strtolower($request->search_on), ["price", "quantity"])) ? $request->search_on : "id";
            $searchText = ($request->search != "") ? e($request->search) : "";

            $productsData = Product::orderBy($searchOn, $orderBy);

            if($searchText != "") {
                $productsData->where('title','LIKE','%'.$searchText."%")->orWhere('content','LIKE','%'.$searchText."%");
            }

            $products = $productsData->paginate(Config::get('app.default_paginate'));

            return view('products.list_product', compact('products'));
        
        } catch (Exception $e) {
            //Save error into the log
            Log::error($e);
            return response()->json(["result" => false, "status" => $e->getCode(), "message" => app('translator')->getFromJson('Something went wrong.')]);
        }
    }

    public function reset()
    {
        $products = Product::paginate(Config::get('app.default_paginate'));
        return view('products.list_product', compact('products'));
    }

}
