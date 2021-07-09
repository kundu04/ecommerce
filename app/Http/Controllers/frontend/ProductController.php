<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function showDetails($slug){

        $data['product']=Product::where('slug',$slug)->where('Active',1)->first();
        if($data['product']==null){
            return redirect()->route('frontend.home');
        }
        $data['productFromSameCategory']=Product::inRandomOrder()
        ->where('category_id',$data['product']->category_id)
        ->where('id','!=',$data['product']->id)
        ->limit(3)
        ->get();
        return view('frontend.products.details',$data);
    }
}
