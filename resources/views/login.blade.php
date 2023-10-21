@extends('layout/main')
@section('title','login')
@section("contact")
<div class="login-form">
    @if (session('message'))
    <div class="mb-3 ">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class='bx bx-check-double mr-2  fa-2x'></i>{{session('message')}}</strong>
            <button type="button" class="btn-close mt-3" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
    @endif
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            @error('email')
            <small class=" text-danger">{{$message}}</small>
        @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password" >
            @error('password')
            <small class=" text-danger">{{$message}}</small>
        @enderror
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{route('auth#register')}}">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection

