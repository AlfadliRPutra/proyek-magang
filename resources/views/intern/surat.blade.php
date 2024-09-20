<x-intern-layout-app>
    @section('title', 'Pengajuan Dokumen')
    <x-intern-layout-header judul='Pengajuan Dokumen'></x-intern-layout-header>

    <div class="container">
        <!-- Menampilkan pesan sukses atau error -->
        <div class="row">
            <div class="col mb-2">
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
            </div>
        </div>

        <!-- Daftar surat -->
        @forelse ($surats as $surat)
            <div class="card mb-1 shadow-sm rounded">
                <!-- Header kartu dengan status warna -->
                <h5 class="card-header {{ $surat->status == 1 ? 'bg-success' : 'bg-secondary' }} text-white small mb-0">
                    {{ $surat->nama }}
                </h5>
                <div class="card-body p-2 small">
                    <!-- Baris pertama: Jenis Dokumen dan Status -->
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <p class="mb-0 me-2">Jenis Dokumen:</p>
                                <p class="mb-0">{{ ucfirst($surat->jenis) }}</p>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0">
                                <span class="badge text-dark {{ $surat->status == 1 ? 'bg-success' : 'bg-light' }}">
                                    {{ $surat->status == 1 ? 'Approved' : 'In Process' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <!-- Baris kedua: Tanggal Pengajuan dan Download -->
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <p class="mb-0 me-2">Tanggal:</p>
                                <p class="mb-0">{{ $surat->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <!-- Tombol download surat -->
                            <a href="{{ $surat->status == 0 ? '#' : asset('storage/hasil_file/' . $surat->hasil_file) }}"
                                class="d-inline-flex align-items-center justify-content-center"
                                style="width: 2rem; height: 2rem; text-decoration: none;"
                                {{ $surat->status == 0 ? 'aria-disabled="true"' : '' }}>
                                <i class="fas fa-download"
                                    style="font-size: 12px; color: {{ $surat->status == 0 ? '#a0a0a0' : '#004aad' }};"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Pesan ketika tidak ada surat tersedia -->
            <p class="text-center small">Tidak ada dokumen diajukan.</p>
        @endforelse

        <!-- Button Tambah di sudut kanan bawah -->
        <div class="position-fixed bottom-0 end-0 mb-4 me-3" style="z-index: 1050; padding-bottom: 3.125rem;">
            <a href="{{ route('intern.surat.create') }}"
                class="btn btn-primary shadow d-flex justify-content-center align-items-center"
                style="background-color: #004aad; width: 2.8125rem; height: 2.8125rem; border-radius: 50%;">
                <i class="fas fa-plus text-white"></i>
            </a>
        </div>
    </div>
</x-intern-layout-app>
