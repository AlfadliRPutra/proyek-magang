<x-intern-layout-app>
    @section('title', 'Profile')

    <x-intern-layout-header judul='Edit profil'></x-intern-layout-header>

    <div class="container bg-light d-flex justify-content-center align-items-center"
        style="min-height: 80vh; padding: 1.25rem; border-radius: 10px; box-sizing: border-box;">

        <form method="POST" enctype="multipart/form-data" action="{{ route('intern.profile.update') }}"
            class="w-100 border border-secondary rounded p-4 shadow" style="max-width: 600px; background-color: #f0f8ff;">

            @csrf
            @method('PUT')

            <!-- Display errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display success messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display error messages -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12 text-center mb-3">
                    <div class="avatar-section position-relative">
                        <!-- File input -->
                        <input type="file" class="d-none" name="foto" id="fileuploadInput"
                            accept=".png, .jpg, .jpeg">
                        <!-- Image preview -->
                        <div class="avatar-preview position-relative">
                            <img id="avatar-preview"
                                src="{{ Auth::user()->interns && Auth::user()->interns->foto ? Storage::url('photo-user/' . Auth::user()->interns->foto) : asset('img/heino.png') }}"
                                alt="Profile Image"
                                style="width: 4.5rem; height: 4.5rem; object-fit: cover; border-radius: 50%;"
                                class="img-fluid rounded-circle shadow-sm">
                            <!-- Upload icon -->
                            <label for="fileuploadInput" class="avatar-upload-icon position-absolute"
                                style="color: white; bottom: 0; right: 0;">
                                <ion-icon name="camera-reverse-outline" style="font-size: 1rem;"></ion-icon>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group mb-4">
                        <label for="name" style="color: #323b60;">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', ucwords(Auth::user()->name)) }}" placeholder="Nama Lengkap"
                            autocomplete="off" style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    </div>

                    <div class="form-group mb-4">
                        <label for="no_hp" style="color: #323b60;">No Handphone</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                            value="{{ old('no_hp', Auth::user()->interns->no_phone ?? '') }}"
                            placeholder="{{ Auth::user()->interns->no_phone ?? '' }}" autocomplete="off"
                            style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    </div>

                    <div class="form-group mb-4">
                        <label for="email" style="color: #323b60;">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                            readonly style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn w-100 py-2"
                            style="background-color: #3A6D8C; color: white; font-size: 16px; border-radius: 8px;">
                            <ion-icon name="refresh-outline"></ion-icon>
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <br>
</x-intern-layout-app>
