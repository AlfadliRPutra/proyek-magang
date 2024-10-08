<x-intern-layout-app>
    @section('title', 'Dashboard')
    <div class="container">
        <!-- User Info Card -->
        <div class="card mb-4">
            <div class="card-body p-3 text-center">
                <!-- Logo Header -->
                <div class="mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Telkom Logo" style="max-width: 140px; height: auto;">
                </div>

                <div class="d-flex align-items-center mb-2">
                    @php
                    $user = Auth::user();
                    $photo =
                    $user->interns && $user->interns->foto
                    ? Storage::url('photo-user/' . $user->interns->foto)
                    : asset('img/heino.png');
                    @endphp
                    <img src="{{ $photo }}" alt="avatar" class="rounded-circle img-fluid me-3"
                        style="width: 4.5rem; height: 4.5rem; object-fit: cover;">
                    <div>
                        <span class="fs-6 fw-bold mb-1">{{ ucwords($user->name) }}</span>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Intern</span>
                            <span class="text-muted">|</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Section -->
        <div class="card mb-4">
            <div class="card-body p-3 text-center">
                <div class="row gx-3">
                    <!-- Menu 1: Activity -->
                    <div class="col-3">
                        <a href="{{ route('intern.goals') }}" class="d-block mb-2"
                            style="font-size: 1.8rem; color: #f0143a;">
                            <i class="fas fa-bullseye"></i>
                        </a>
                        <span class="text-muted">Goals!</span>
                    </div>

                    <!-- Menu 2: Fasilitas -->
                    <div class="col-3">
                        <a href="{{ route('intern.fasilitas') }}" class="d-block mb-2" style="font-size: 1.8rem; color: #f0143a;">
                            <i class="fas fa-building"></i>
                        </a>
                        <span class="text-muted">Fasilitas</span>
                    </div>

                    <!-- Menu 3: Histori -->
                    <div class="col-3">
                        <a href="/presensi/history" class="d-block mb-2" style="font-size: 1.8rem; color: #f0143a;">
                            <i class="fas fa-history"></i>
                        </a>
                        <span class="text-muted">Histori</span>
                    </div>

                    <!-- Menu 4: Divisi -->
                    <div class="col-3">
                        <a href="{{ route('intern.unit') }}" class="d-block mb-2"
                            style="font-size: 1.8rem; color: #f0143a;">
                            <i class="fas fa-network-wired"></i>
                        </a>
                        <span class="text-muted">Divisi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Presence Section -->
        <div class="div">
            <div class="card-body p-3">
                <div class="row row-cols-2 row-cols-sm-2 g-4">
                    <!-- Card for Masuk -->
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-3 d-flex align-items-center">
                                @if ($presensiToday && !empty($presensiToday->in_hour) && !empty($presensiToday->foto_in))
                                <img src="{{ Storage::url('uploads/presensi/' . $presensiToday->foto_in) }}" class="img-fluid rounded-circle" style="max-width: 2rem;">
                                @else
                                <i class="fas fa-camera-retro" style="font-size: 1.5rem; color: #f0143a;"></i>
                                @endif
                                <div class="ms-3">
                                    <div class="fs-7 fw-bold mb-1">Masuk</div>
                                    <div>{!! $presensiToday && !empty($presensiToday->in_hour)
                                        ? $presensiToday->in_hour
                                        : 'Belum Absen' !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card for Pulang -->
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-3 d-flex align-items-center">
                                @if ($presensiToday && !empty($presensiToday->out_hour) && !empty($presensiToday->foto_out))
                                <img src="{{ Storage::url('uploads/presensi/' . $presensiToday->foto_out) }}" class="img-fluid rounded-circle" style="max-width: 2rem;">
                                @else
                                <i class="fas fa-camera-retro" style="font-size: 1.5rem; color: #f0143a;"></i>
                                @endif
                                <div class="ms-3">
                                    <div class="fs-7 fw-bold mb-1">Pulang</div>
                                    <div>{!! $presensiToday && !empty($presensiToday->out_hour)
                                        ? $presensiToday->out_hour
                                        : 'Belum Absen' !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Rekap Presensi Section -->
        <div class="card mb-4">
            <div class="card-body p-3">
                <span class="fs-6 fw-bold mb-4 d-block">Rekap Presensi</span>
                <div class="row gx-3">
                    @foreach ([['icon' => 'check-circle', 'count' => $rekapPresensi->jmlhadir, 'label' => 'Hadir'], ['icon' => 'calendar-check', 'count' => $rekapizin->jmlizin, 'label' => 'Izin'], ['icon' => 'notes-medical', 'count' => $rekapizin->jmlsakit, 'label' => 'Sakit'], ['icon' => 'clock', 'count' => $rekapPresensi->jmlterlambat, 'label' => 'Telat']] as $item)
                    <div class="col-3">
                        <div class="card position-relative">
                            <div class="position-absolute" style="top: 10px; right: 10px; font-size: 1rem; color: red;">
                                {{ $item['count'] }}
                            </div>
                            <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center text-center">
                                <i class="fas fa-{{ $item['icon'] }} text-muted" style="font-size: 1.6rem;"></i>
                                <div class="fs-8 text-muted mt-2">{{ $item['label'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>



        <!-- Presensi Tab -->
        <div class="card mb-4">
            <div class="card-body p-3">
                <span class="fs-6 fw-bold mb-4 d-block">Presensi</span>
                <div class="tab-content">
                    <div class="tab-pane fade show active">
                        <ul class="list-group p-0">
                            @forelse ($historyThisMonth as $history)
                            @php
                            $path = Storage::url('uploads/presensi/' . $history->foto_in);
                            $date = date('l, d-m-Y', strtotime($history->date_attendance));
                            @endphp
                            <li class="list-group-item d-flex align-items-center py-2">
                                <div class="d-flex flex-column" style="font-size: 0.75rem;">
                                    <div class="mb-1"><strong>{{ $date }}</strong></div>
                                    <div class="d-flex">
                                        <span class="badge bg-light text-dark" style="font-size: 0.75rem;">
                                            {{ $history->in_hour }}
                                        </span>
                                        <span class="badge bg-light text-dark" style="font-size: 0.75rem;">
                                            {{ $history->out_hour ?? 'Belum Presensi' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ms-auto" style="font-size: 1rem;">
                                    <i class="fas fa-address-card"></i>
                                </div>
                            </li>
                            @empty
                            <li class="list-group-item p-3">No records found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Section -->
        <div class="card mb-4">
            <div class="card-body p-3">
                <span class="fs-6 fw-bold mb-4 d-block">Events</span>
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        @foreach ($events as $key => $event)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/events/' . $event->file) }}" class="d-block w-100"
                                alt="{{ $event->nama }}" style="object-fit: cover; height: 18.75rem;">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
</x-intern-layout-app>