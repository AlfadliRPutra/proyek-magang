<x-admin-layout-app>
    @section('title', 'Data Absensi Intern')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Izin</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="fas fa-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Menu</a>
                </li>
                <li class="separator">
                    <i class="fas fa-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Izin</a>
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
                        {{-- Table --}}
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Tanggal Izin</th>
                                        <th>Alasan</th>
                                        <th>File</th>
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
                                        <th>File</th>
                                        <th>Keterangan</th>
                                        <th>Status Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($absensis as $is)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($is->id_pengguna) }}</td>
                                            <td>{{ ucwords($is->pengguna->name) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($is->date_izin)) }}</td>
                                            <td>{{ $is->status == '1' ? 'Izin' : 'Sakit' }}</td>
                                            <td>
                                                @if (strpos($is->file, '.pdf') !== false)
                                                    <a href="#"
                                                        onclick="openModal('{{ asset('storage/' . $is->file) }}'); return false;">
                                                        <i class="fas fa-file-pdf"></i> Preview
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $is->file) }}" target="_blank">
                                                        <i class="fas fa-download"></i> Download
                                                    </a>
                                                @endif
                                            </td>
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
                                                <form action="{{ route('admin.absensi.update') }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $is->id }}">
                                                    <select name="status_approved" class="form-select" required>
                                                        <option value="" disabled selected>Pilih Status</option>
                                                        <option value="1">Disetujui</option>
                                                        <option value="2">Ditolak</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-primary mt-2">
                                                        <i class="fas fa-edit"></i> Simpan
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- End Table --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal HTML -->
    <div id="pdfPreviewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="pdfPreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Ikon Close dengan styling dari Bootstrap -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfPreviewIframe" src="" class="w-100"
                        style="height: 80vh; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <x-table-script></x-table-script>

    @push('scripts')
        <script>
            $(function() {
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

                // Handle the approval button click
                $('.approve-button').on('click', function() {
                    const id = $(this).data('id');
                    $('#absensiId').val(id); // Set the absensi ID
                    $('#approvalModal').modal('show'); // Show the modal
                });

                // Handle form submission
                $('#approvalForm').on('submit', function(e) {
                    e.preventDefault();
                    const status = $('#approvalStatus').val();
                    const absensiId = $('#absensiId').val();

                    // Add your AJAX request to update the status here
                    // Example:
                    $.ajax({
                        url: '{{ route('admin.absensi.update') }}', // Replace with your actual URL
                        type: 'POST',
                        data: {
                            id: absensiId,
                            status: status,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Handle success response
                            $('#approvalModal').modal('hide');
                            // Optionally refresh the page or update the table
                            location.reload(); // Reload the page
                        },
                        error: function(xhr) {
                            // Handle error response
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
                });
            });
        </script>
        <script>
            function openModal(pdfUrl) {
                var pdfModal = new bootstrap.Modal(document.getElementById('pdfPreviewModal'));
                document.getElementById('pdfPreviewIframe').src = pdfUrl;
                pdfModal.show();
            }

            function closeModal() {
                var pdfModal = bootstrap.Modal.getInstance(document.getElementById('pdfPreviewModal'));
                document.getElementById('pdfPreviewIframe').src = ''; // Clear the iframe src
                pdfModal.hide();
            }
        </script>
    @endpush
</x-admin-layout-app>
