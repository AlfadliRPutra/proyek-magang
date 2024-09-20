@push('scripts')
    <!-- Datatables -->
    <script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
    <!-- Datatables -->
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});

            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d +
                                        "</option>");
                                });
                        });
                },
            });

            // Add Row
            $("#add-row").DataTable({
                pageLength: 5,
            });
            $("#frmintern").submit(function() {
                var nik = $("#nik").val();
                var name = $("#name").val();
                var email = $("#email").val();
                var no_hp = $("#no_hp").val();
                var role = $("#role").val();
                if (nik == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nik Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#nik").focus();
                    });
                    return false;
                } else if (email == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Email Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#email").focus();
                    });
                    return false;
                } else if (no_hp == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'No Handphone Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#no_hp").focus();
                    });
                    return false;
                } else if (role == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Role Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#role").focus();
                    });
                    return false;
                }
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $("#addRowButton").click(function() {
                $("#add-row")
                    .dataTable()
                    .fnAddData([$("#addName").val(), $("#addPosition").val(), $("#addOffice").val(),
                        action
                    ]);
                $("#addRowModal").modal("hide");
            });
        });
    </script>
@endpush
