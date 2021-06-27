<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $path = storage_path() . "/json/products.json";
        $products = json_decode(file_get_contents($path), true);

        return view('product.form-add', $products, compact('products'));
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
        $request->validate([
            'product_name' => 'required|max:255',
            'quantity' => 'required',
            'price' => 'required',
        ]);
//        dd($request->all());
        $path = storage_path() . "/json/products.json";
        $data = json_decode(file_get_contents($path), true);
        $newItem = [
            'id' => count($data) + 1,
            'name' => $request->product_name,
            'quantity'=> $request->quantity,
            'price' => $request->price,
            'datetime' => Carbon::now()
        ];
        array_push($data, $newItem);

        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, stripslashes($newJsonString));

        return response()->json([
            'message' => 'Product created successfully!'
        ]);
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
        $path = storage_path() . "/json/products.json";
        $products = json_decode(file_get_contents($path), true);
        $product = [];
        foreach ($products as $val) {
            if ($val['id'] == $id) {
                $product = $val;
            }
        }

        return view('product.form-edit', compact('products', 'product'));
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
        $request->validate([
            'product_name' => 'required|max:255',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $path = storage_path() . "/json/products.json";
        $data = json_decode(file_get_contents($path), true);

        foreach ($data as $index => $val) {
            if ($val['id'] == $id) {
                $updatedItem = [
                    'id' => $id,
                    'name' => $request->product_name,
                    'quantity'=> $request->quantity,
                    'price' => $request->price,
                    'datetime' => Carbon::now()
                ];
                $data[$index] = $updatedItem;
            }
        }
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, stripslashes($newJsonString));

        return redirect(route('product.index'))->with('success', 'Your Product has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = storage_path() . "/json/products.json";
        $data = json_decode(file_get_contents($path), true);

        foreach ($data as $index => $val) {
            if ($val['id'] == $id) {
                array_splice($data, $index, 1);
            }
        }
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, stripslashes($newJsonString));
        return response()->json([
            'message' => 'Product deleted successfully!'
        ]);
    }
}
