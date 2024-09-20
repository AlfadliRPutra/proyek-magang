<x-admin-layout-app>
    @section('title', 'Konfigurasi Lokasi')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Kantor</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Kantor</a>
                </li>

            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                @if (Session::get('success'))
                    <div id="alert_success" class="d-none">{{ Session::get('success') }}</div>
                @endif

                @if (Session::get('error'))
                    <div id="alert_error" class="d-none">{{ Session::get('error') }}</div>
                @endif
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Lokasi Kantor</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label"> Lokasi Kantor </label>
                                    <p class="form-control-static">
                                        {{ $loc_office->location_office }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label"> Radius </label>
                                    <p class="form-control-static">
                                        {{ $loc_office->radius }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <a class="btn btn-warning" href="{{ route('admin.office.setting') }}">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(function() {
                // SweetAlert2 initialization for success and warning alerts
                if ($("#alert_success").length) {
                    Swal.fire({
                        title: 'Kelazzzz!',
                        text: $("#alert_success").text(),
                        icon: 'success',
                        confirmButtonClass: 'btn btn-success',
                    });
                }

                if ($("#alert_error").length) {
                    Swal.fire({
                        title: 'Error!',
                        text: $("#alert_error").text(),
                        icon: 'error',
                        confirmButtonClass: 'btn btn-danger',
                    });
                }
            });
        </script>
    @endpush
</x-admin-layout-app>
