<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function showCart(){
       dd(session()->get('cart'));
    }
    public function addToCart(Request $request){
        try{
            $this->validate($request,[
                'product_id'=>'required|numeric',
            ]);
        }catch(ValidationException $e){
            return redirect()->back();
        }

        $product=Product::findOrFail($request->product_id);
        $cart=session()->has('cart')?session()->get('cart'):[];
        if(array_key_exists($product->id,$cart)){
            $cart[$product->id]['quantity']++;
        }
        else{
            $cart[$product->id]=[
                'title'=>$product->title,
                'quantity'=>1,
                'price'=>($product->sale_price != null && $product->sale_price > 0)? $product->sale_price:$product->price,
            ];
        }
        
        session(['cart'=>$cart]);
        
        return redirect()->route('cart.show');
    }
}
