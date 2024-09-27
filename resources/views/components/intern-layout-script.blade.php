<!-- Core JS Files -->
<script src="{{ asset('js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

<!-- Additional Plugins -->
<script src="{{ asset('js/plugin/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/plugin/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


<!-- Bootstrap Notify -->
<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<!-- Sweet Alert -->
{{-- <script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}" ></script> --}}

<!-- Base Js File -->
<script src="{{ asset('js/base.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('js/kaiadmin.min.js') }}"></script>

<!-- Script to hide loader -->
<script>
    // Script untuk menyembunyikan scrollbar saat loader muncul
    window.onload = function() {
        document.getElementById('loader').style.display = 'none';
        document.body.classList.remove('loader-active'); // Hapus kelas saat loading selesai
    };

    // Saat loader muncul, tambahkan kelas ke body
    document.body.classList.add('loader-active'); // Tambahkan kelas saat loading dimulai
</script>


@stack('myscript')
