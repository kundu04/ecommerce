@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        
        <br>
        <p class="text-center">Cart</p>
        <hr> 
        @if(session()->has('message')) 
        <div class="alert alert-success">{{session()->get('message')}}</div> 
        @endif
        @if(empty($cart))
        <div class="alert alert-success">No items</div>
        @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Serial</td>
                            <td>Product</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    @php 
                    $i=1;
                    @endphp
                    @foreach($cart as $key=>$product)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$product['title']}}</td>
                            <td><input type="number" name="quantity" value="{{$product['quantity']}}"></td>
                            <td>BDT {{$product['price']}}</td>
                            <td>
                            <form action="{{route('cart.remove')}}" method="post">@csrf
                            <input type="hidden" name="product_id" value="{{$key}}">
                            <button type="submit" class="btn btn-sm btn-outline-danger text-uppercase">Remove</button>
                            </form>
                            </td>
                        </tr>
                    
                    @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>BDT {{number_format($total,2)}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
              @endif  
           
       
    </div>
@endsection