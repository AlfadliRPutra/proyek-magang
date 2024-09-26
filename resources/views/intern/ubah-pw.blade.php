<x-intern-layout-app>
    @section('title', 'Ubah Password')
    <x-intern-layout-header judul='Ubah Password'></x-intern-layout-header>

    <div class="container bg-light d-flex justify-content-center align-items-center"
        style="min-height: 80vh; padding: 1.25rem; border-radius: 10px; box-sizing: border-box;">

        <div class="w-100 border border-secondary rounded p-4 shadow"
            style="max-width: 600px; background-color: #f0f8ff;">

            <div class="row">
                <div class="col-12">
                    <!-- Email input -->
                    <div class="form-group mb-4">
                        <label for="email" style="color: #323b60;">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                            readonly style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    </div>

                    <!-- Password input -->
                    <div class="form-group mb-4">
                        <label for="password" style="color: #323b60;">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan password baru" autocomplete="off"
                            style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    </div>

                    <!-- Confirm password input -->
                    <div class="form-group mb-4">
                        <label for="confirm_password" style="color: #323b60;">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirm_password"
                            name="confirm_password" placeholder="Konfirmasi password baru" autocomplete="off"
                            style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    </div>

                    <!-- Buttons -->
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn w-45 py-2"
                            style="background-color: #3A6D8C; color: white; font-size: 16px; border-radius: 8px;">
                            <ion-icon name="refresh-outline"></ion-icon>
                            Update Password
                        </button>

                      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
</x-intern-layout-app>
