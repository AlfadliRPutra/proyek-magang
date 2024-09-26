<div class="appBottomMenu fixed-bottom d-flex align-items-center justify-content-around border-top border-light p-1 shadow-sm"
    style="background-color: #ffffff; border-radius: 0.5rem 0.5rem 0 0; border: 1.5px solid #ddd;">

    <!-- Link to Dashboard -->
    <a href="{{ route('intern.dashboard') }}"
        class="btn btn-link {{ request()->routeIs('intern.dashboard') ? 'text-primary bg-lightblue' : 'text-secondary bg-light' }} text-center d-flex flex-column align-items-center justify-content-center"
        style="width: 3rem; height: 3rem; padding: 0; border-radius: 0.5rem;">
        <i class="fas fa-home" style="font-size: 1.25rem; margin: auto; color: #0077b6;"></i>
        @if (request()->routeIs('intern.dashboard'))
            <strong class="d-block" style="font-size: 0.5rem; color: #0077b6;">HOME</strong>
        @endif
    </a>

    <!-- Link to Documents -->
    <a href="{{ route('intern.surat') }}"
        class="btn btn-link {{ request()->routeIs('intern.surat') ? 'text-primary bg-lightblue' : 'text-secondary bg-light' }} text-center d-flex flex-column align-items-center justify-content-center"
        style="width: 3rem; height: 3rem; padding: 0; border-radius: 0.5rem;">
        <i class="fas fa-file-alt" style="font-size: 1.25rem; margin: auto; color: #0077b6;"></i>
        @if (request()->routeIs('intern.surat'))
            <strong class="d-block" style="font-size: 0.5rem; color: #0077b6;">DOCUMENTS</strong>
        @endif
    </a>

    <!-- Presensi button condition -->
    @if (request()->routeIs('intern.presensi.create'))
        @if (isset($cek) && $cek > 0)
            <div class="btn rounded-circle d-flex align-items-center justify-content-center"
                style="width: 3rem; height: 3rem; background-color: #f7e7a6; color: #333; padding: 0; border: 2px solid #ddd;">
                <button id="takepresensi-navbar"
                    class="btn btn-block d-flex flex-column align-items-center justify-content-center"
                    style="background-color: #f7e7a6; color: #333; padding: 0; border: none;">
                    <i class="fas fa-camera" style="font-size: 1.25rem; margin: auto; color: #333;"></i>
                </button>
            </div>
        @else
            <div class="btn rounded-circle d-flex align-items-center justify-content-center"
                style="width: 3rem; height: 3rem; background-color: #00b4d8; color: white; padding: 0; border: 2px solid #ddd;">
                <a href="#" id="takepresensi-navbar" style="color: white; padding: 0;">
                    <i class="fas fa-camera" style="font-size: 1.25rem; margin: auto; color: white;"></i>
                </a>
            </div>
        @endif
    @else
        <a href="{{ route('intern.presensi.create') }}"
            class="btn rounded-circle d-flex align-items-center justify-content-center"
            style="width: 3rem; height: 3rem; background-color: #00b4d8; color: white; padding: 0; border: 2px solid #ddd;">
            <i class="fas fa-camera" style="font-size: 1.25rem; margin: auto; color: white;"></i>
        </a>
    @endif

    <!-- Link to Attendance -->
    <a href="{{ route('intern.absensi') }}"
        class="btn btn-link {{ request()->routeIs('intern.absensi') ? 'text-primary bg-lightblue' : 'text-secondary bg-light' }} text-center d-flex flex-column align-items-center justify-content-center"
        style="width: 3rem; height: 3rem; padding: 0; border-radius: 0.5rem;">
        <i class="fas fa-calendar-alt" style="font-size: 1.25rem; margin: auto; color: #0077b6;"></i>
        @if (request()->routeIs('intern.absensi'))
            <strong class="d-block" style="font-size: 0.5rem; color: #0077b6;">IZIN</strong>
        @endif
    </a>

    <!-- Link to Profile -->
    <a href="{{ route('intern.profile') }}"
        class="btn btn-link {{ request()->routeIs('intern.profile') ? 'text-primary bg-lightblue' : 'text-secondary bg-light' }} text-center d-flex flex-column align-items-center justify-content-center"
        style="width: 3rem; height: 3rem; padding: 0; border-radius: 0.5rem;">
        <i class="fas fa-user" style="font-size: 1.25rem; margin: auto; color: #0077b6;"></i>
        @if (request()->routeIs('intern.profil'))
            <strong class="d-block" style="font-size: 0.5rem; color: #0077b6;">PROFILE</strong>
        @endif
    </a>
</div>
