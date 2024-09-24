@push('myscript')
    <script>
        $(document).ready(function() {
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
