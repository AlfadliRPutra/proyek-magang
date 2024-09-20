<x-admin-layout-app>
    @section('title', 'Data Absensi Intern')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Absensi</h3>
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
                    <a href="#">absensi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                @if (Session::get('success'))
                    <div id="alert_demo_3_3"></div>
                @endif

                @if (Session::get('warning'))
                    <div id="alert_demo_3_2"></div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Absensi</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- modal --}}
                        <div class="modal fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">Tinjau</span>
                                            <span class="fw-light"> permohonan </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">Pilih status</p>
                                        <form action="{{ route('admin.absensi.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_izinsakit_form" id="id_izinsakit_form">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <select name="status_approved" id="status_approved"
                                                            class="form-select">
                                                            <option value="1">Disetujui</option>
                                                            <option value="2">Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary w-100 mt-3"
                                                            type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}

                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Tanggal Izin</th>
                                        <th>Alasan</th>
                                        <th>Keterangan</th>
                                        <th>Status Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Tanggal Izin</th>
                                        <th>Alasan</th>
                                        <th>Keterangan</th>
                                        <th>Status Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($izinsakit as $is)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($is->id_pengguna) }}</td>
                                            <td>{{ ucwords($is->name) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($is->date_izin)) }}</td>
                                            <td>{{ $is->status == '1' ? 'Izin' : 'Sakit' }}</td>
                                            <td>{{ $is->keterangan }}</td>
                                            <td>
                                                @if ($is->status_approved == 1)
                                                    <span class="badge text-bg-success">Disetujui</span>
                                                @elseif ($is->status_approved == 2)
                                                    <span class="badge text-bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge text-bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($is->status_approved == 0)
                                                    <a href="#" class="btn btn-sm btn-primary" id="approve"
                                                        id_izinsakit="{{ $is->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                            <path d="M11 13l9 -9" />
                                                            <path d="M15 4h5v5" />
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="/data/absensi/{{ $is->id }}/hapusizin"
                                                        class="btn btn-sm btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-x">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 10l4 4m0 -4l-4 4" />
                                                            <path
                                                                d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                        </svg>
                                                        Batalkan
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-table-script></x-table-script>
    @push('scripts')
        <script>
            $(function() {
                $("#approve").click(function(e) {
                    e.preventDefault();
                    var id_izinsakit = $(this).attr("id_izinsakit");
                    $("#id_izinsakit_form").val(id_izinsakit);
                    $("#modal-izinsakit").modal("show");
                });

                // SweetAlert2 initialization for success and warning alerts
                if ($("#alert_demo_3_3").length) {
                    swal("Kelazz", "Berhasil Ubah Status", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                }

                if ($("#alert_demo_3_2").length) {
                    swal("Oops!", "Gagal Ubah Status", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: "btn btn-danger",
                            },
                        },
                    });
                }
            });
        </script>
    @endpush
</x-admin-layout-app>
