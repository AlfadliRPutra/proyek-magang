<x-admin-layout-app>
    @section('title', 'Konfigurasi Lokasi')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Konfigurasi</h3>
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
                    <a href="{{ route('admin.office') }}">Kantor</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Konfigurasi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                @if (Session::get('success'))
                    <div id="alert_demo_3_3" class="d-none">{{ Session::get('success') }}</div>
                @endif

                @if (Session::get('error'))
                    <div id="alert_demo_3_2" class="d-none">{{ Session::get('error') }}</div>
                @endif
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Konfigurasi</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('admin.event.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Event</label>
                                            <input type="text" id="nama" name="nama" placeholder="Nama Event"
                                                class="form-control" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="file" style="width: 100%;">File</label>
                                            <input type="file" class="form-control-file" id="file"
                                                name="file" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tanggal_mulai">Tanggal Mulai</label>
                                            <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                                placeholder="Tanggal Mulai" class="form-control" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="durasi">Durasi (Hari)</label>
                                            <input type="number" id="durasi" name="durasi" placeholder="Durasi"
                                                class="form-control" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a class="btn btn-danger" href="{{ route('admin.event') }}">Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
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
            });
        </script>
    @endpush

</x-admin-layout-app>
