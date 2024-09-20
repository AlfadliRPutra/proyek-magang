<x-intern-layout-app>
    @section('title', 'Buat Pengajuan Dokumen')
    <x-intern-layout-header judul='Buat Pengajuan Dokumen'></x-intern-layout-header>

    @php
        $messageSuccess = Session::get('success');
        $messageError = Session::get('error');
    @endphp

    @if ($messageSuccess)
        <div class="alert alert-success">{{ $messageSuccess }}</div>
    @endif

    @if ($messageError)
        <div class="alert alert-danger">{{ $messageError }}</div>
    @endif

    <div class="container bg-white d-flex justify-content-center align-items-center"
        style="min-height: 80vh; padding: 20px; border-radius: 8px;">
        <form action="{{ route('intern.surat.store') }}" method="POST" enctype="multipart/form-data" id="frmSurat"
            class="w-100 border border-secondary rounded p-4" style="max-width: 600px;">
            @csrf

            <!-- Input Nama Surat -->
            <div class="form-group mb-2">
                <label for="namaSurat" class="form-label">Perihal</label>
                <input type="text" name="nama" class="form-control" id="namaSurat"
                    placeholder="Masukkan Nama Surat" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input jenis -->
            <div class="form-group mb-2">
                <label for="jenisSurat" class="form-label">Jenis Dokumen</label>
                <select name="jenis" class="form-select" id="jenisSurat" required>
                    <option value="" disabled selected>Pilih</option>
                    <option value="pribadi">Pribadi</option>
                    <option value="resmi">Resmi</option>
                    <option value="umum">Umum</option>
                </select>
                @error('jenis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input File Surat -->
            <div class="form-group mb-2">
                <label for="fileSurat" class="form-label">Unggah File Surat (PDF/Word)</label>
                <input class="form-control" type="file" name="file" id="fileSurat" accept=".pdf,.doc,.docx"
                    required>
                @error('file')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn w-100 py-1" style="background-color: #323b60; color: white;">
                Submit
            </button>
        </form>
    </div>

    @push('myscript')
        <script>
            $(document).ready(function() {
                $("#frmSurat").submit(function(event) {
                    var nama = $("#namaSurat").val();
                    var jenis = $("#jenisSurat").val();
                    var file = $("#fileSurat").val();

                    if (nama == "") {
                        $("#namaSurat").after('<div class="text-danger">Nama Surat Harus Diisi</div>');
                        event.preventDefault();
                    } else if (jenis == "") {
                        $("#jenisSurat").after('<div class="text-danger">jenis Harus Diisi</div>');
                        event.preventDefault();
                    } else if (file == "") {
                        $("#fileSurat").after('<div class="text-danger">File Harus Diupload</div>');
                        event.preventDefault();
                    }
                });
            });
        </script>
    @endpush
</x-intern-layout-app>
