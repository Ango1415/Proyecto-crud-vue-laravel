<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id){
        return Product::find($id);
    }

    public function showByUser($userId){
        return Product::find($userId);
    }
    
    public function index(){
        return Product::all();
    }

    public function store(Request $request){
        $productFields = $request->validate([
            'name' => 'required',
            'bar_code' => 'required',
            'price' => 'required',
            'user' => 'required',
        ]);
        Product::create($productFields);
        return response()->json([
            'data'=> $productFields,
            'message' => 'Product succesfuly created!'
        ]);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        if(isset($product)){
            $product['name'] = $request['name'];
            $product['bar_code'] = $request['bar_code'];
            $product['price'] = $request['price'];
            $product['user'] = $request['user'];

            $product->save();
            return response()->json([
                'data'=> $product,
                'message' => 'Product succesfuly updated!'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Product not updated'
            ]);
        }
    }

    public function destroy($id){
        $product = Product::find($id);
        if(isset($product)){
            Product::destroy($id);
            return response()->json([
                'data' => $product,
                'message' => 'Product successfuly deleted!',
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'Product not deleted'
            ]);
        }

    }
}
