<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class FrontController extends Controller
{
    public function index(){
        $data['products']=Product::select(['id','title','slug','description','price','sale_price'])
        ->where('active',1)
        ->simplePaginate(10);

        return view('frontend.home',$data);
    }
}
