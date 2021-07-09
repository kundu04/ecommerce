@extends('frontend.layouts.master')
@section('content')

<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @foreach($products as $product)
        <div class="col">
        
          <div class="card shadow-sm">

            <img  class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{$product->getFirstMediaUrl('products')}}" alt="{{$product->title}}">

            <div class="card-body">
              <p class="card-text">
              {{$product->title}}
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <form action="{{route('cart.add')}}" method="post">@csrf
                  <input type="hidden" name="product_id" value="{{$product->id}}">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                  </form>
                </div>
                <small class="text-muted">BDT {{$product->price}}</small>
              </div>
            </div>
          </div>
        

        </div>
        @endforeach
      
      </div>
      {{$products->links()}}
    </div>
  </div>
  @endsection