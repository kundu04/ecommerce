@extends('frontend.layouts.master')
@section('content')
<div class="container">
        
        <br>
        <p class="text-center">Register</p>
        <hr> 
        @include('frontend.partial._messages')
        <form class="form" action="{{route('register')}}" method="post">@csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" name="password" required>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">
                    Register
                </button>
            </div>
        </form>
</div>
@endsection