<x-intern-layout-app>
    @section('title', 'Profile')

    <x-intern-layout-header judul='Edit profil'></x-intern-layout-header>
    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('intern.profile.update') }}">
            @csrf
            @method('PUT')
            <!-- Hidden field for id_pengguna -->
            <input type="hidden" name="id_pengguna" value="{{ Auth::user()->id_pengguna }}">

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
                                class="img-fluid rounded-circle">
                            <!-- Upload icon -->
                            <label for="fileuploadInput" class="avatar-upload-icon position-absolute"
                                style="color:white; bottom: 0; right: 0;">
                                <ion-icon name="camera-reverse-outline" style="font-size: 1rem;"></ion-icon>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', ucwords(Auth::user()->name)) }}" placeholder="Nama Lengkap"
                            autocomplete="off" />
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No Handphone</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                            value="{{ old('no_hp', Auth::user()->interns->no_phone ?? '') }}"
                            placeholder="{{ Auth::user()->interns->no_phone ?? '' }}" autocomplete="off" />
                    </div>

                    <!-- Static email field -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                            readonly />
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-block">
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
