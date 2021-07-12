@extends('frontend.layouts.master')
@section('content')
<div class="container">
        
        <br>
        <p class="text-center">Login</p>
        <hr> 
        @include('frontend.partial._messages')
        <form class="form" action="{{route('login')}}" method="post">@csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" name="password" required>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">
                    Login
                </button>
            </div>
        </form>
</div>
@endsection