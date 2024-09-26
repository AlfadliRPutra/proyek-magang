<x-intern-layout-app>
    @section('title', 'Reset Password')

    <x-intern-layout-header judul='Reset Password'></x-intern-layout-header>

    <div class="container bg-light d-flex justify-content-center align-items-center"
        style="min-height: 80vh; padding: 1.25rem; border-radius: 10px; box-sizing: border-box;">

        <form method="POST" action="{{ route('password.update') }}"
            class="w-100 border border-secondary rounded p-4 shadow" style="max-width: 600px; background-color: #f0f8ff;">
            @csrf
            <input type="hidden" name="token" value="{{ $request->token }}">

            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-4">
                        <label for="email" style="color: #323b60;">E-Mail Address</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                            style="border: 1px solid #3A6D8C; background-color: #eaf2fb;">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password" style="color: #323b60;">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" style="border: 1px solid #3A6D8C; background-color: #eaf2fb;">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password-confirm" style="color: #323b60;">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password"
                            style="border: 1px solid #3A6D8C; background-color: #eaf2fb;">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn w-100 py-2"
                            style="background-color: #3A6D8C; color: white; font-size: 16px; border-radius: 8px;">
                            <ion-icon name="refresh-outline"></ion-icon>
                            Reset Password
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <br>
</x-intern-layout-app>
