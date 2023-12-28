@extends('user.authLayout')
@section('content')
<div class="col-md-8 ps-md-0">
    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo logo-light d-block mb-2">Qtec Solution Limited</a>
        <h5 class="text-warning fw-normal mb-4">
            Admin Login
        </h5>
        <form class="forms-sample" method="POST" action="{{ route('user.login') }}">
            @csrf
            @if(session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
            <div class="mb-3">
                <label for="userEmail" class="form-label text-info">Email
                    address</label>
                <input type="email" class="form-control" id="userEmail" placeholder="Email" name="email" />
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label text-info">Password</label>
                <input type="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password" name="password" />
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="authCheck" />
                <label class="form-check-label" for="authCheck">
                    Remember me
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</button>
            </div>
            <a href="{{ route('user.register') }}" class="d-block mt-3 text-warning">Not a user?
                Sign
                up</a>
        </form>
    </div>
</div>
@endsection