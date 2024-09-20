<x-admin-layout-app>
    @section('title', 'Data intern')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Master</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data Master</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                @if (Session::get('success'))
                    <div id="alert_demo_3_3" class="d-none">{{ Session::get('success') }}</div>
                @endif

                @if (Session::get('error'))
                    <div id="alert_demo_3_2" class="d-none">{{ Session::get('error') }}</div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Peserta Magang</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>

                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- modal --}}
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold"> New</span>
                                            <span class="fw-light"> Row </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">Create a new row using this form, make sure you fill them all
                                        </p>
                                        <form action="{{ route('admin.intern.store') }}" method="POST" id="frmintern">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>NIK</label>
                                                        <input type="text" id="nik" name="nik"
                                                            class="form-control" placeholder="Nomor Induk Kepegawaian">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pe-0">
                                                    <div class="form-group form-group-default">
                                                        <label>Nama</label>
                                                        <input type="text" id="name" class="form-control"
                                                            name="name" placeholder="Nama Lengkap intern">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>Email</label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pe-0">
                                                    <div class="form-group form-group-default">
                                                        <label>No. HP</label>
                                                        <input type="tel" name="no_hp" id="no_hp"
                                                            class="form-control"
                                                            placeholder="No Handphone Aktif intern">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="role" id="role" class="form-select">
                                                        <option selected disabled>Role</option>
                                                        <option
                                                            value="intern"{{ old('role') == 'intern' ? 'selected' : '' }}>
                                                            intern</option>
                                                        <option
                                                            value="Admin"{{ old('role') == 'Admin' ? 'selected' : '' }}>
                                                            Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="submit" id="addRowButton"
                                                    class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>



                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}

                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Name</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Unit</th>
                                        <th>Handphone</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Name</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Unit</th>
                                        <th>Handphone</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($interns as $k)
                                        @php
                                            $photoPath =
                                                $k->interns && $k->interns->foto
                                                    ? Storage::disk('public')->url('photo-user/' . $k->interns->foto)
                                                    : asset('img/heino.png');
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($k->id_pengguna) }}</td>
                                            <td>{{ ucwords($k->name) }}</td> <!-- Mengakses name dari model User -->
                                            {{-- <td>{{ $k->email }}</td> <!-- Mengakses email dari model User --> --}}
                                            <td>{{ $k->interns && $k->interns->unitListing ? $k->interns->unitListing->unit_name : '-' }}
                                            </td>
                                            <td>{{ $k->interns ? $k->interns->no_phone : '-' }}</td>
                                            <td>
                                                <img src="{{ $photoPath }}" class="avatar"
                                                    style="width: 4.5rem; height: 4.5rem; object-fit: cover;"
                                                    alt="">
                                            </td>
                                            <td>
                                                <div class="flex">
                                                    <span class="me-2">
                                                        <a href="{{ url('admin/intern/' . $k->id . '/edit') }}"
                                                            class="badge text-bg-warning mt-2" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            {{-- Edit --}}
                                                        </a>
                                                    </span>
                                                    <span>
                                                        <form action="{{ route('admin.intern.delete', $k->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <!-- Pastikan menggunakan metode DELETE untuk penghapusan -->
                                                            <button type="submit" class="badge text-bg-danger mt-1"
                                                                title="Delete"
                                                                style="border: none; background: none;">
                                                                <i class="fas fa-trash-alt"></i>
                                                                {{-- Hapus --}}
                                                            </button>
                                                        </form>

                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-table-script></x-table-script>
    @push('scripts')
        <script>
            $(document).ready(function() {
                if ($("#alert_demo_3_3").length) {
                    swal({
                        title: 'Kelazz!',
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
</x-admin-layout-app>
