<x-admin-layout-app>
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tinjau Data Surat</h3>
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
                    <a href="{{ route('admin.surat') }}">Data Surat</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tinjau Surat</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tinjau Surat</div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (Session::get('warning'))
                                <div class="alert alert-warning">
                                    {{ Session::get('warning') }}
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('admin.surat.update', $surat->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama</label>
                                        <p class="form-control-static">{{ strtoupper($surat->nama) }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jenis</label>
                                        <p class="form-control-static">{{ strtoupper($surat->jenis) }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <p class="form-control-static">
                                            {{ strtoupper($surat->status == 0 ? 'Diproses' : ($surat->status == 1 ? 'Selesai' : 'Status tidak diketahui')) }}
                                        </p>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label">Pengirim</label>
                                        <p class="form-control-static">
                                            {{ strtoupper($surat->pengirim ? $surat->pengirim->name : '-') }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">File</label> <br>
                                        @if (strpos($surat->file, '.pdf') !== false)
                                            <a href="{{ asset('storage/surats/' . $surat->file) }}" target="_blank">
                                                <i class="fas fa-file-pdf"></i> Download File
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/surats/' . $surat->file) }}" target="_blank">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="hasil_file">File Hasil</label>
                                        <input type="file" class="form-control" id="hasil_file" name="hasil_file">
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a class="btn btn-danger" href="{{ route('admin.surat') }}">Cancel</a>
                            </div>
                        </form>
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
