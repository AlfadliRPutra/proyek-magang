<x-admin-layout-app>
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Data</h3>
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
                    <a href="{{ route('admin.intern') }}">Data Master</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Data</div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (Session::get('warning'))
                                <div class="alert alert-warning">
                                    {{ Session::get('warning') }}
                                </div>
                            @endif
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.intern.update', $intern->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-6">

                                    <div class="form-group">
                                        <label class="control-label"> Nama </label>
                                        <p class="form-control-static">
                                            {{ strtoupper($intern->name) }}
                                        </p>
                                        <input type="hidden" name="id_pengguna" value="{{ $intern->id_pengguna }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> NIM </label>
                                        <p class="form-control-static">
                                            {{ strtoupper($intern->id_pengguna) }}
                                        </p>
                                    </div>


                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <select class="form-select" id="unit" name="unit_id">
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a class="btn btn-danger" href="{{ route('admin.intern') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout-app>
