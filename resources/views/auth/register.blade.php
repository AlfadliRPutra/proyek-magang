@extends('layouts.app')

@section('content')
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <!-- Hide this div on small screens -->
            <div class="col-md-9 col-lg-6 col-xl-5 d-none d-md-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
                    alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <div class="container d-flex justify-content-center align-items-center"
                    style="min-height: 110vh; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <!-- Nama input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="name">{{ __('Nama') }}</label>
                            <input id="name" type="text"
                                class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="Nama Lengkap">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <!-- ID Pengguna input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="id_pengguna">{{ __('NIM') }}</label>
                            <input id="id_pengguna" type="text"
                                class="form-control form-control-lg @error('id_pengguna') is-invalid @enderror"
                                name="id_pengguna" value="{{ old('id_pengguna') }}" required autocomplete="id_pengguna"
                                placeholder="Nomor Induk Mahasiswa">
                            @error('id_pengguna')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">{{ __('Email') }}</label>
                            <input id="email" type="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                                required autocomplete="new-password" placeholder="Kata Sandi">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password-confirm">{{ __('Konfirmasi Kata Sandi') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Konfirmasi Kata Sandi">
                        </div>

                        <!-- Submit button -->
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Daftar') }}</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Sudah memiliki akun?
                                <a href="{{ route('login') }}" class="link-danger">{{ __('Login di sini') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
