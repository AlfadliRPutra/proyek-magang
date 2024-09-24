<header class="bg-white text-dark py-1 px-3 d-flex justify-content-between align-items-center shadow-sm rounded-bottom"
    style="border-bottom: 1px solid #ddd;">
    <div class="d-flex align-items-center" style="width: 20px;">
        <a href="{{ url()->previous() }}" class="btn btn-link text-dark p-0">
            <i class="fas fa-chevron-left" style="font-size: 12px;"></i>
        </a>
    </div>
    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <span style="font-size: 16px; font-weight: 600; letter-spacing: 0.85px;">{{ $judul }}</span>

    </div>
    <div class="d-flex align-items-center" style="width: 20px;">
        <!-- Ikon kanan atau div kosong -->
    </div>
</header>
