<x-intern-layout-app>
    @section('title', 'Ketidakhadiran')
    <x-intern-layout-header judul="Pengajuan Izin"></x-intern-layout-header>

    <div class="row">
        <div class="col">
            @php
                $messageSuccess = Session::get('success');
                $messageError = Session::get('error');
            @endphp

            @if ($messageSuccess)
                <div class="alert alert-success">{{ $messageSuccess }}</div>
            @endif

            @if ($messageError)
                <div class="alert alert-danger">{{ $messageError }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            @forelse ($dataizin as $di)
                <div class="card mb-2 shadow-sm rounded" style="margin-top: 0.5rem;">
                    <!-- Card Header -->
                    <!-- Card Header -->
                    <div class="card-header {{ $di->status == 's' ? 'bg-warning' : 'bg-info' }} text-white d-flex justify-content-between align-items-center"
                        style="font-size: 0.75rem; padding: 0.5rem;">
                        <span>
                            {{ $di->status == 's' ? 'Sakit' : 'Izin' }}
                        </span>
                        <span>
                            {{ date('d-m-Y', strtotime($di->date_izin)) }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-3">
                        <div class="row">
                            <!-- Description -->
                            <div class="col-8">
                                <p class="mb-2 text-muted" style="font-size: 0.875rem;">{{ $di->keterangan }}</p>
                            </div>
                            <!-- Status -->
                            <div class="col-4 text-end">
                                @if ($di->status_approved == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($di->status_approved == 1)
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($di->status_approved == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center small">No permission requests submitted.</p>
            @endforelse
        </div>
    </div>

    <!-- Button Tambah di sudut kanan bawah -->
    <div class="position-fixed bottom-0 end-0 mb-4 me-3" style="z-index: 1050; padding-bottom: 3.125rem;">
        <a href="{{ route('intern.absensi.form') }}"
            class="btn btn-primary shadow d-flex justify-content-center align-items-center"
            style="background-color: #004aad; width: 2.8125rem; height: 2.8125rem; border-radius: 50%;">
            <i class="fas fa-plus text-white"></i>
        </a>
    </div>
</x-intern-layout-app>
