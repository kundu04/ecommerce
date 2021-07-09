<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function showCart(){
        $data['cart']=session()->has('cart')?session()->get('cart'):[];
        $data['total']=array_sum(array_column($data['cart'],'price'));
        return view('frontend.cart',$data);
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
        session()->flash('message',$product->title.' added to cart.');
        return redirect()->route('cart.show');
    }

    public function removeCart(Request $request){
        try{
            $this->validate($request,[
                'product_id'=>'required|numeric',
            ]);
        }catch(ValidationException $e){
            return redirect()->back();
        }
        
        $cart=session()->has('cart')?session()->get('cart'):[];
        unset($cart[$request->product_id]);
        session(['cart'=>$cart]);
        session()->flash('message','product removed from cart.');
        return redirect()->back();
    }
}
