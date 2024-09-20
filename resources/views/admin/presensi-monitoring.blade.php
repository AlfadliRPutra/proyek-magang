<x-admin-layout-app>
    @section('title', 'Monitoring Presensi Intern')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Monitoring</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ url('/') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Menu</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Monitoring</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('warning'))
                    <div class="alert alert-warning">
                        {{ Session::get('warning') }}
                    </div>
                @endif
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Daftar Hadir</h4>
                            <div class="form-group ms-auto">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                    <input type="text" id="tanggal" name="tanggal" class="form-control"
                                        placeholder="Tanggal Presensi" autocomplete="off">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nik</th>
                                        <th>Nama</th>
                                        <th>Jam Masuk</th>
                                        <th>Foto Presensi Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Foto Presensi Pulang</th>
                                        <th>Keterangan</th>
                                        <th>Lokasi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nik</th>
                                        <th>Nama</th>
                                        <th>Jam Masuk</th>
                                        <th>Foto Presensi Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Foto Presensi Pulang</th>
                                        <th>Keterangan</th>
                                        <th>Lokasi</th>
                                    </tr>
                                </tfoot>
                                <tbody id="loadpresensi"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-table-script></x-table-script>

    <div class="modal modal-blur fade" id="modal-showmap" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lokasi Presensi User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadmap"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <script>
            $(function() {
                $("#tanggal").datepicker({
                    dateFormat: "yy-mm-dd",
                    defaultDate: "{{ date('Y-m-d') }}",
                    onSelect: function(dateText, inst) {
                        loadPresensi(dateText);
                    }
                });

                function loadPresensi(tanggal) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('admin.getpresensi') }}',
                        data: {
                            _token: "{{ csrf_token() }}",
                            tanggal: tanggal
                        },
                        cache: false,
                        beforeSend: function() {
                            $("#loadpresensi").html(
                                '<tr><td colspan="9" class="text-center">Loading...</td></tr>');
                        },
                        success: function(response) {
                            $("#loadpresensi").html(response);
                        },
                        error: function() {
                            $("#loadpresensi").html(
                                '<tr><td colspan="9" class="text-center text-danger">Failed to load data.</td></tr>'
                            );
                        }
                    });
                }

                // Load initial data with today's date
                loadPresensi("{{ date('Y-m-d') }}");
            });
        </script>
    @endpush


</x-admin-layout-app>
