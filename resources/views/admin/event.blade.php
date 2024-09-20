<x-admin-layout-app>
    @section('title', 'Event')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Event</h3>
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
                    <a href="#">Event</a>
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
                            <h4 class="card-title">Event</h4>
                            <a href="{{ route('admin.event.create') }}" class="btn btn-primary btn-round ms-auto">

                                <i class="fa fa-plus"></i>

                            </a>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Durasi</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Durasi</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $event->nama }}</td>
                                            <td>{{ $event->tanggal_mulai }}</td>
                                            <td>{{ $event->durasi }}</td>
                                            <td>
                                                @if ($event->file)
                                                    <a href="{{ asset('storage/events/' . $event->file) }}"
                                                        target="_blank">
                                                        View File
                                                    </a>
                                                @else
                                                    No File
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Actions, e.g., Edit, Delete -->
                                                {{-- <a href="{{ route('events.edit', $event->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form> --}}
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
