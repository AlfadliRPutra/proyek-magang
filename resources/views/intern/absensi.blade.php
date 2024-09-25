<x-intern-layout-app>
    @section('title', 'Ketidakhadiran')
    <x-intern-layout-header judul="Pengajuan Izin"></x-intern-layout-header>

    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (Session::get('success'))
                    <div id="alert_demo_3_3" class="d-none">{{ Session::get('success') }}</div>
                @endif

                @if (Session::get('error'))
                    <div id="alert_demo_3_2" class="d-none">{{ Session::get('error') }}</div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col">
                @forelse ($dataizin as $di)
                    <div class="card mb-2 shadow-sm rounded" style="margin-top: 0.5rem;">
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
    </div>

    <div class="position-fixed" style="bottom: 4.5rem; right: 1.5rem; z-index: 1050;">
        <a href="{{ route('intern.absensi.form') }}"
            class="btn btn-primary shadow d-flex justify-content-center align-items-center"
            style="background-color: #004aad; width: 2.8125rem; height: 2.8125rem; border-radius: 50%;">
            <i class="fas fa-plus text-white"></i>
        </a>
    </div>
    @push('myscript')
        <script>
            $(document).ready(function() {
                if ($("#alert_demo_3_3").length) {
                    swal({
                        title: 'Kelazz!',
                        text: $("#alert_demo_3_3").text(),
                        icon: 'success',
                        button: {
                            text: "OK",
                            className: "btn btn-success"
                        }
                    });
                }

                if ($("#alert_demo_3_2").length) {
                    swal({
                        title: 'Error!',
                        text: $("#alert_demo_3_2").text(),
                        icon: 'error',
                        button: {
                            text: "OK",
                            className: "btn btn-danger"
                        }
                    });
                }
                $('.delete-form').on('submit', function(e) {
                    e.preventDefault(); // Mencegah form untuk dikirim langsung

                    var form = $(this);
                    swal({
                        title: 'Konfirmasi Penghapusan',
                        text: 'Apakah Anda yakin ingin menghapus item ini?',
                        icon: 'warning',
                        buttons: {
                            cancel: {
                                text: "Batal",
                                visible: true,
                                className: "btn btn-secondary",
                                closeModal: true
                            },
                            confirm: {
                                text: "Hapus",
                                className: "btn btn-danger"
                            }
                        },
                        dangerMode: true
                    }).then((willDelete) => {
                        if (willDelete) {
                            form.off('submit').submit(); // Kirim form jika dikonfirmasi
                        }
                    });
                });
            });
        </script>
    @endpush

</x-intern-layout-app>
