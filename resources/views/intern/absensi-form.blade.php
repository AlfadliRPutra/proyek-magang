<x-intern-layout-app>
    @section('title', 'Form Pengajuan Izin')
    <x-intern-layout-header judul="Pengajuan Izin"></x-intern-layout-header>

    @php
        $messageSuccess = Session::get('success');
        $messageError = Session::get('error');
    @endphp

    <div class="container bg-light d-flex justify-content-center align-items-center"
        style="min-height: 80vh; padding: 20px; border-radius: 10px;">
        <form action="{{ route('intern.absensi.form.store') }}" method="POST" id="frmIzin"
            class="w-100 border border-secondary rounded p-4" style="max-width: 600px; background-color: #f0f8ff;"
            enctype="multipart/form-data">
            @csrf

            <!-- Input Tanggal Izin -->
            <div class="form-group mb-2">
                <label for="date_izin" class="form-label" style="color: #323b60;">Tanggal Izin</label>
                <input type="date" name="date_izin" id="date_izin" class="form-control" required
                    style="border: 1px solid #3A6D8C; background-color: #eaf2fb;" />
            </div>

            <!-- Input Status -->
            <div class="form-group mb-2">
                <label for="status" class="form-label" style="color: #323b60;">Status</label>
                <select name="status" id="status" class="form-select" required
                    style="border: 1px solid #3A6D8C; background-color: #eaf2fb;">
                    <option value="" selected disabled>Status</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                </select>
            </div>

            <!-- Input Keterangan -->
            <div class="form-group mb-2">
                <label for="keterangan" class="form-label" style="color: #323b60;">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" required
                    placeholder="Keterangan" style="border: 1px solid #3A6D8C; background-color: #eaf2fb;"></textarea>
            </div>

            <!-- Input Unggah Dokumen -->
            <div class="form-group mb-2">
                <label for="fileSurat" class="form-label" style="color: #323b60;">Unggah Dokumen (PDF)</label>
                <input class="form-control" type="file" name="file" id="fileSurat" accept=".pdf" required
                    style="border: 1px solid #3A6D8C; background-color: #eaf2fb;">
            </div>

            <!-- Tombol Submit -->
            <div class="form-group mb-4">
                <button class="btn w-100 py-2"
                    style="background-color: #3A6D8C; color: white; font-size: 16px; border-radius: 8px;">
                    <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>

    @push('myscript')
        <script>
            $(document).ready(function() {
                $("#frmIzin").submit(function(e) {
                    var date_izin = $("#date_izin").val();
                    var status = $("#status").val();
                    var keterangan = $("#keterangan").val();
                    var file = $("#fileSurat").val();

                    if (!date_izin) {
                        e.preventDefault();
                        swal.fire({
                            title: 'Oops!',
                            text: 'Tanggal Harus Diisi',
                            icon: 'warning',
                            confirmButtonColor: '#3A6D8C',
                            customClass: {
                                confirmButton: 'btn btn-warning'
                            }
                        });
                    } else if (!status) {
                        e.preventDefault();
                        swal.fire({
                            title: 'Oops!',
                            text: 'Status Harus Diisi',
                            icon: 'warning',
                            confirmButtonColor: '#3A6D8C',
                            customClass: {
                                confirmButton: 'btn btn-warning'
                            }
                        });
                    } else if (!keterangan) {
                        e.preventDefault();
                        swal.fire({
                            title: 'Oops!',
                            text: 'Keterangan Harus Diisi',
                            icon: 'warning',
                            confirmButtonColor: '#3A6D8C',
                            customClass: {
                                confirmButton: 'btn btn-warning'
                            }
                        });
                    } else if (!file) {
                        e.preventDefault();
                        swal.fire({
                            title: 'Oops!',
                            text: 'File Dokumen Harus Diupload',
                            icon: 'warning',
                            confirmButtonColor: '#3A6D8C',
                            customClass: {
                                confirmButton: 'btn btn-warning'
                            }
                        });
                    }
                });

                if ($("#alert_demo_3_3").length) {
                    swal.fire({
                        title: 'Berhasil!',
                        text: $("#alert_demo_3_3").text(),
                        icon: 'success',
                        confirmButtonColor: '#3A6D8C',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }

                if ($("#alert_demo_3_2").length) {
                    swal.fire({
                        title: 'Error!',
                        text: $("#alert_demo_3_2").text(),
                        icon: 'error',
                        confirmButtonColor: '#3A6D8C',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            });
        </script>
    @endpush
</x-intern-layout-app>
