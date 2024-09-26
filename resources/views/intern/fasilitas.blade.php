<x-intern-layout-app>
    @section('title', 'Ketidakhadiran')
    <x-intern-layout-header judul="Fasilitas"></x-intern-layout-header>

    <!-- Menu Section -->
    <div class="container my-4">
        <div class="card-body p-3 text-center">
            <div class="row gx-3">
                <!-- Baris 1 -->
                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'mushola') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-mosque"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Mushola</span>
                </div>

                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'gym') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-dumbbell"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Gym</span>
                </div>

                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'badminton') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-shuttlecock"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Badminton</span>
                </div>

                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'sepeda') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-bicycle"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Sepeda</span>
                </div>
            </div>

            <div class="row gx-3">
                <!-- Baris 2 -->
                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'panahan') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-bow-arrow"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Panahan</span>
                </div>


                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'basket') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-basketball-ball"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Basket</span>
                </div>

                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'yoga') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-person"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Yoga</span>
                </div>

                <div class="col-3 mb-4">
                    <a href="{{ route('fasilitas.show', 'tennis') }}" class="d-block mb-2"
                        style="font-size: 1.8rem; color: #1abc9c;">
                        <i class="fas fa-table-tennis"></i>
                    </a>
                    <span style="font-size: 0.9rem; color: black;">Tenis Meja</span>
                </div>
            </div>

            <div class="row gx-3">
                <!-- Baris 3 -->
                <div class="row gx-3">
                    <!-- Baris 3 -->
                    <div class="col-3 mb-4">
                        <a href="{{ route('fasilitas.show', 'tenislapangan') }}" class="d-block mb-2"
                            style="font-size: 1.4rem; color: #1abc9c;">
                            <i class="fas fa-tennis-ball"></i>
                        </a>
                        <a href="{{ route('fasilitas.show', 'tenislapangan') }}"
                            style="font-size: 0.8rem; color: inherit; text-decoration: none;">
                            <span>Tenis Lapangan </span>
                        </a>
                    </div>

                    <div class="col-3 mb-4">
                        <a href="{{ route('fasilitas.show', 'kantin') }}" class="d-block mb-2"
                            style="font-size: 1.8rem; color: #1abc9c;">
                            <i class="fas fa-utensils"></i>
                        </a>
                        <span style="font-size: 0.9rem; color: black;">Kantin</span>
                    </div>

                    <!-- Kosongkan kolom untuk keselarasan -->
                    <div class="col-3 mb-4"></div>
                    <div class="col-3 mb-4"></div>
                </div>
            </div>
        </div>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
</x-intern-layout-app>
