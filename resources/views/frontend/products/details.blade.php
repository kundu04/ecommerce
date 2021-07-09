@extends('frontend.layouts.master')
@section('content')
<div class="container">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <section class="gallery-wrap">
                    <div class="img-big-wrap">
                        <a href="#"><img src="{{$product->getFirstMediaUrl('products')}}"  width=350></a>
                    </div>
                </section>

            </aside>
            <aside class="col-sm-7">
            
                <section class="card-body p-5">
                    <h3 class="title mb-3">{{$product->name}}</h3>
                    <p class="price-detail-wrap">
                        <span class="price h3 text-danger">
                            <span class="currency">BDT {{$product->price}}</span>
                        </span>
                    </p>
                    <h3>Description</h3>
                    <p>{!! $product->description !!}</p>
                   
                    
                    <hr>
                    <form action="{{route('cart.add')}}" method="post">@csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button type="submit" class="btn btn-lg btn-outline-primary text-uppercase">Add to Cart</button>
                    </form>
                </section>

            </aside>
        </div>
    </div>

    <div class="jumbotron">
        <h3>YOU MAY ALSO LIKE</h3>
            <div class="row">
            @foreach($productFromSameCategory as $similarProducts)

                <div class="col-4">
                    <div class="card shadow-sm">
                        <img src="{{$product->getFirstMediaUrl('products')}}" class="bd-placeholder-img card-img-top" width="100%" height="225">
                        <div class="card-body">
                                <p><b>{{$similarProducts->title}}</b></p>
                            <p class="card-text">{{$similarProducts->description}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('product.details',$similarProducts->slug)}}"><button type="button" class="btn btn-sm btn-outline-primary">View</button></a>
                                    <form action="{{route('cart.add')}}" method="post">@csrf
                                    <input type="hidden" name="product_id" value="{{$similarProducts->id}}">
                                    <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase">Add to Cart</button>
                                    </form>                                </div>
                                <small class="text-muted">BDT {{$similarProducts->price}}</small>
                            </div>
                        </div>
                    </div>
                </div>
              
                @endforeach

            </div>
    </div>
</div>
@endsection