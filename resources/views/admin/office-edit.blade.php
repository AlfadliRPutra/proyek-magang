<x-admin-layout-app>
    @section('title', 'Konfigurasi Lokasi')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Konfigurasi</h3>
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
                    <a href="{{ route('admin.office') }}">Kantor</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Konfigurasi</a>
                </li>
            </ul>
        </div>
        <div class="row">


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Konfigurasi</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('admin.office.setting.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Lokasi Kantor">Lokasi Kantor</label>
                                            <input type="text" id="Lokasi Kantor" name="location_office"
                                                placeholder="{{ $loc_office->location_office }}" class="form-control"
                                                value="{{ $loc_office->location_office }}" />
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="radius">Radius (Meter)</label>
                                            <input type="text" id="radius" name="radius"
                                                placeholder="{{ $loc_office->radius }}" class="form-control"
                                                value="{{ $loc_office->radius }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a class="btn btn-danger" href="{{ route('admin.office') }}">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-admin-layout-app>
