@extends('layouts.app')

@section('content')
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <!-- Hide this div on small screens -->
            <div class="col-md-9 col-lg-6 col-xl-5 d-none d-md-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
                    alt="Sample image">
            </div>
            <!-- Add container for form -->
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <div class="container d-flex justify-content-center align-items-center"
                    style="min-height: 92vh; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="Enter a valid email address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                                required autocomplete="current-password" placeholder="Enter password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Login') }}</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
                                <a href="{{ route('register') }}" class="link-danger">{{ __('Register') }}</a>
                            </p>
                            <!-- Move Forgot Password link here -->
                            <p class="small mt-3 mb-0">
                                <a href="{{ route('password.request') }}"
                                    class="text-body">{{ __('Forgot Password?') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
