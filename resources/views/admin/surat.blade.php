<x-admin-layout-app>
    @section('title', 'Data Surat')

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

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Surat</h3>
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
                    <a href="#">Surat</a>
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
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Surat</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>File</th>
                                        <th>Status</th>
                                        <th>Pengirim</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>File</th>
                                        <th>Status</th>
                                        <th>Pengirim</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($surats as $surat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $surat->nama }}</td>
                                            <td>{{ ucwords($surat->jenis) }}</td>
                                            <td>
                                                @if (strpos($surat->file, '.pdf') !== false)
                                                    <a href="#"
                                                        onclick="openModal('{{ asset('storage/surats/' . $surat->file) }}'); return false;">
                                                        <i class="fas fa-file-pdf"></i> Preview
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/surats/' . $surat->file) }}"
                                                        target="_blank">
                                                        <i class="fas fa-download"></i> Download
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($surat->status == 0)
                                                    Diproses
                                                @elseif($surat->status == 1)
                                                    Selesai
                                                @else
                                                    Status tidak diketahui
                                                @endif
                                            </td>
                                            <td>{{ $surat->pengirim ? $surat->pengirim->name : '-' }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <span class="me-2">
                                                        <a href="{{ url('admin/surat/' . $surat->id . '/edit') }}"
                                                            class="badge text-bg-warning" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </span>
                                                    <span>
                                                        <form action="{{ route('admin.surat.delete', $surat->id) }}"
                                                            method="POST" class="delete-form" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="badge text-bg-danger"
                                                                title="Delete" style="border: none; background: none;">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data surat</td>
                                        </tr>
                                    @endforelse
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
