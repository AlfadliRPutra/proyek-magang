<!-- Core JS Files -->
<script src="{{ asset('js/core/jquery-3.7.1.min.js') }}" defer></script>
<script src="{{ asset('js/core/popper.min.js') }}" defer></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}" defer></script>

<!-- Additional Plugins -->
<script src="{{ asset('js/plugin/jquery-3.4.1.min.js') }}" defer></script>
<script src="{{ asset('js/plugin/popper.min.js') }}" defer></script>
<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('js/plugins/owl-carousel/owl.carousel.min.js') }}" defer></script>
<script src="{{ asset('js/plugins/jquery-circle-progress/circle-progress.min.js') }}" defer></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}" defer></script>


<!-- Bootstrap Notify -->
<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}" defer></script>


<!-- Sweet Alert -->
<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}" defer></script>

<!-- Base Js File -->
<script src="{{ asset('js/base.js') }}" defer></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('js/kaiadmin.min.js') }}" defer></script>

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
