<x-intern-layout-app>
    @section('title', 'Form Pengajuan Izin')
    <x-intern-layout-header judul="Pengajuan Izin"></x-intern-layout-header>

    <div class="col-12">
        @if (Session::get('success'))
            <div id="alert_demo_3_3"></div>
        @endif

        @if (Session::get('warning'))
            <div id="alert_demo_3_2"></div>
        @endif
    </div>
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="{{ route('intern.absensi.form.store') }}" method="POST" id="frmIzin">
                @csrf
                <div class="form-group">
                    <input type="date" name="date_izin" id="date_izin" class="form-control" placeholder="Tanggal"
                        required />
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control" required>
                        <option value="" selected disabled>Status</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"
                        required></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    @push('myscript')
        <script>
            $(document).ready(function() {
                // Validasi form sebelum submit
                $("#frmIzin").submit(function(e) {
                    var date_izin = $("#date_izin").val();
                    var status = $("#status").val();
                    var keterangan = $("#keterangan").val();

                    if (!date_izin) {
                        swal({
                            title: 'Oops !',
                            text: 'Tanggal Harus Diisi',
                            icon: 'warning',
                            button: {
                                text: "OK",
                                className: "btn btn-warning"
                            }
                        });
                        e.preventDefault();
                    } else if (!status) {
                        swal({
                            title: 'Oops !',
                            text: 'Status Harus Diisi',
                            icon: 'warning',
                            button: {
                                text: "OK",
                                className: "btn btn-warning"
                            }
                        });
                        e.preventDefault();
                    } else if (!keterangan) {
                        swal({
                            title: 'Oops !',
                            text: 'Keterangan Harus Diisi',
                            icon: 'warning',
                            button: {
                                text: "OK",
                                className: "btn btn-warning"
                            }
                        });
                        e.preventDefault();
                    }
                });

                // SweetAlert custom alerts
                if ($("#alert_demo_3_3").length) {
                    swal({
                        title: 'Berhasil!',
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
</x-intern-layout-app>
