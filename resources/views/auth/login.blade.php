@extends('layouts.auth')

@section('content')

<div class="p-5">
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Login to your account!</h1>
    </div>
    <form class="user" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user" id="exampleInputEmail"
                placeholder="Email Address">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group ">
            <input type="password" value="{{ old('password') }}" name="password" class="form-control form-control-user"
                id="exampleRepeatPassword" placeholder="Repeat Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Login
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
    </div>
</div>
@endsection
