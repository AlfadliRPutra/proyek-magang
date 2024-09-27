<x-intern-layout-app>
    @section('title', 'Ubah Password')
    <x-intern-layout-header judul='Ubah Password'></x-intern-layout-header>

    <div class="container bg-light d-flex justify-content-center align-items-center"
        style="min-height: 80vh; padding: 1.25rem; border-radius: 10px; box-sizing: border-box;">

        <div class="w-100 border border-secondary rounded p-4 shadow"
            style="max-width: 600px; background-color: #f0f8ff;">

            <!-- Status message -->
            @if (session('status') == 'password-updated')
                <div class="alert alert-success" role="alert">
                    {{ __('Password Updated') }}
                </div>
            @endif

            <!-- Error messages -->
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <!-- Password Update Form -->
            <form method="POST" action="{{ route('user-password.update') }}">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="form-group mb-4">
                    <label for="current_password" style="color: #323b60;">{{ __('Current Password') }}</label>
                    <input id="current_password" type="password"
                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                        name="current_password" required autofocus
                        style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    @error('current_password', 'updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group mb-4">
                    <label for="password" style="color: #323b60;">{{ __('New Password') }}</label>
                    <input id="password" type="password"
                        class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password"
                        required autocomplete="new-password"
                        style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    @error('password', 'updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group mb-4">
                    <label for="password_confirmation" style="color: #323b60;">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password"
                        style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                </div>

                <!-- Submit Button -->
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="border-radius: 8px;">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-intern-layout-app>
