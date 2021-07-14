@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        
        <br>
        <p class="text-center">checkout</p>
        <hr> 
        @guest()
        <div class="alert alert-danger"> 
            You need to <a href="{{route('login')}}">Login</a> first to complete your order.
        </div>
        @else
        
        @include('frontend.partial._messages')
        <div class="alert alert-info"> 
            You are ordering as {{auth()->user()->name}}
        </div>
        @endguest

        
        <main>
           
            <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill">{{count($cart)}}</span>
                </h4>
                
                <ul class="list-group mb-3">
                @foreach($cart as $key => $product)
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0">{{$product['title']}}</h6>
                    <small class="text-muted">{{$product['quantity']}}</small>
                    </div>
                    <span class="text-muted">{{number_format($product['total_price'],2)}}</span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (BDT)</span>
                    <strong>{{number_format($total,2)}}</strong>
                </li>
                </ul>
                
                <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
                </form>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form action="{{route('order')}}" method="post">@csrf
                <div class="row g-3">
                    <div class="col-12">
                    <label for="username" class="form-label">Customer Name</label>
                    <div class="input-group has-validation">                      
                        <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}"  required>
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="Phone_number" class="form-label">Customer Phone Number</label>
                    <div class="input-group has-validation">                      
                        <input type="text" class="form-control" name="Phone_number" value="{{auth()->user()->phone_number}}"  required>
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                    </div>


                   <div class="row">
                   <div class="col-md-5">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" placeholder="city">
                   
                    </div>

                    <div class="col-md-5">
                    <label for="post_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" name="post_code" placeholder="postal code">
                   
                    </div>
                   </div>
                </div>

               
                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
            </div>
            </div>
        </main>
    </div>
@endsection