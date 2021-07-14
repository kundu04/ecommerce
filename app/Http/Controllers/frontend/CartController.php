<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function showCart(){
        $data['cart']=session()->has('cart')?session()->get('cart'):[];
        $data['total']=array_sum(array_column($data['cart'],'total_price'));
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
        $unit_price=($product->sale_price != null && $product->sale_price > 0)? $product->sale_price:$product->price;
        $cart=session()->has('cart')?session()->get('cart'):[];
        
        if(array_key_exists($product->id,$cart)){
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total_price'] = $cart[$product->id]['quantity'] *  $cart[$product->id]['unit_price'];
        }
        else{
            $cart[$product->id]=[
                'title'=>$product->title,
                'quantity'=>1,
                'unit_price'=>$unit_price,
                'total_price'=>$unit_price,
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

    public function clearCart(){
        session(['cart'=>[]]);
        return redirect()->back();
    }

    public function checkout(){

        $data['cart']=session()->has('cart')?session()->get('cart'):[];
        $data['total']=array_sum(array_column($data['cart'],'total_price'));
        return view('frontend.checkout',$data);
    }

    public function processOrder(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'Phone_number'=>'required|min:11|numeric',
            'address'=>'required',
            'city'=>'required',
            'post_code'=>'required',
        ]);

        $cart=session()->has('cart')?session()->get('cart'):[];
        $total=array_sum(array_column($cart,'total_price'));

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
            $orderInfo = Order::create([
                'user_id'=>auth()->user()->id,
                'customer_name' => $request['name'],
                'customer_phone_number' => $request['Phone_number'],
                'address' => $request['address'],
                'postal_code' => $request['post_code'],
                'city' => $request['city'],
                'total_amount'=>$total,
                'paid_amount'=>$total,
                'payment_details'=>'Cash on delivery',
            ]);
            
            foreach($cart as $product_id => $product){
                $orderInfo->products()->create([
                    'product_id' => $product_id,
                    'quantity' => $product['quantity'],
                    'price' => $product['total_price'],
                ]);
            }
            session()->flash('type','success');
            session()->flash('message','Information recorded! Please check your (email)...');
            
            session()->forget(['cart','total']);
            
            return redirect()->back();
            
        

    }
}
