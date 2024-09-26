<x-admin-layout-app>
    @section('title', 'Export Presensi Intern')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Export Presensi Intern</h3>
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
                    <a href="#">Interns</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Export Presensi</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pilih Intern untuk Export Presensi</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Form for selecting intern and export options -->
                            <form action="{{ route('admin.export.presensi') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <!-- Dropdown for selecting intern -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="intern">Pilih Intern</label>
                                            <select id="intern" name="intern_id" class="form-control" required>
                                                <option value="">Pilih Intern</option>
                                                @foreach ($interns as $intern)
                                                    <option value="{{ $intern->id }}">{{ $intern->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Export options -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="export_format">Format Export</label>
                                            <select id="export_format" name="export_format" class="form-control"
                                                required>
                                                <option value="pdf">PDF</option>
                                                <option value="excel">Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="card-action">
                                    <button type="submit" class="btn btn-primary">Export</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout-app>
