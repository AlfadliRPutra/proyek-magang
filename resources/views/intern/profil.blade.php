<x-intern-layout-app>
    @section('title', 'Profile')

    <x-intern-layout-header judul='Profil'></x-intern-layout-header>

    <div class="container bg-light d-flex justify-content-center align-items-center"
        style="min-height: 80vh; padding: 1.25rem; border-radius: 10px; box-sizing: border-box;">

        <div class="w-100 border border-secondary rounded p-4" style="max-width: 600px; background-color: #f0f8ff;">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <div class="avatar-section position-relative">
                        <div class="avatar-preview position-relative">
                            <img src="{{ Auth::user()->interns && Auth::user()->interns->foto ? Storage::url('photo-user/' . Auth::user()->interns->foto) : asset('img/heino.png') }}"
                                alt="Profile Image"
                                style="width: 4.5rem; height: 4.5rem; object-fit: cover; border-radius: 50%;"
                                class="img-fluid rounded-circle shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group mb-4">
                        <label for="name" style="color: #323b60;">Nama Lengkap</label>
                        <p class="form-control-plaintext ms-2">
                            {{ ucwords(Auth::user()->name) }}
                        </p>
                    </div>

                    <div class="form-group mb-4">
                        <label for="no_hp" style="color: #323b60;">No Handphone</label>
                        <p class="form-control-plaintext ms-2">
                            {{ Auth::user()->interns->no_phone ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="form-group mb-4">
                        <label for="email" style="color: #323b60;">Email</label>
                        <p class="form-control-plaintext ms-2">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <!-- Buttons for Edit Profile, Change Password, and Logout -->
                    <div class="form-group">
                        <a href="{{ route('intern.profile.edit') }}" class="btn w-100 py-2 mb-2"
                            style="background-color: #3A6D8C; color: white; font-size: 12px; border-radius: 8px;">
                            <i class="fas fa-user-edit" style="margin-right: 5px;"></i>
                            Edit Profil
                        </a>
                        <a href="{{ route('intern.ubah-pw') }}" class="btn w-100 py-2 mb-2"
                            style="background-color: #3A6D8C; color: white; font-size: 12px; border-radius: 8px;">
                            <i class="fas fa-key" style="margin-right: 5px;"></i>
                            Ubah Password
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="w-100 py-2 mb-2">
                            @csrf
                            <button type="submit" class="btn w-100 d-flex align-items-center justify-content-center"
                                style="background-color: #FF4500; color: white; font-size: 12px; border-radius: 8px; padding: 8px 16px;">
                                <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <br><br>
</x-intern-layout-app>
