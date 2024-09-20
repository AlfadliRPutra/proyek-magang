@if ($presensi->isEmpty())
    <tr>
        <td colspan="9" class="text-center">Tidak ada data Hari ini</td>
    </tr>
@else
    @foreach ($presensi as $p)
        @php
            $foto_in = Storage::url('uploads/presensi/' . $p->foto_in);
            $foto_out = Storage::url('uploads/presensi/' . $p->foto_out);
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ strtoupper($p->id_pengguna) }}</td>
            <td>{{ ucwords($p->name) }}</td>
            <td>{{ $p->in_hour }}</td>
            <td>
                <img src="{{ url($foto_in) }}" class="avatar" alt="">
            </td>
            <td>{!! $p->out_hour != null ? $p->out_hour : '<span class="badge text-bg-danger">Belum Pulang</span>' !!}</td>
            <td>
                @if ($p->out_hour != null)
                    <img src="{{ url($foto_out) }}" class="avatar" alt="">
                @else
                    <i class="fas fa-hourglass"></i>
                @endif
            </td>
            <td>
                @if ($p->in_hour <= '08:00:00')
                    <span class="badge text-bg-success">Tepat Waktu</span>
                @elseif ($p->in_hour > '08:00:00' && $p->in_hour <= '11:00:00')
                    <span class="badge text-bg-danger">Terlambat</span>
                @elseif ($p->in_hour > '11:00:00' && $p->in_hour < '12:00:00')
                    <span class="badge text-bg-danger">Tidak Masuk</span>
                @endif
            </td>
            <td>
                <button class="btn btn-primary showmap" id="{{ $p->id }}">
                    <i class="fas fa-map-marker-alt"></i>
                </button>
            </td>
        </tr>
    @endforeach
@endif


<script>
    $(function() {
        $(".showmap").click(function(e) {
            e.preventDefault(); // Prevent default action

            var id = $(this).attr("id");
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.presensi.showmap', ['id' => '__ID__']) }}'.replace(
                    '__ID__', id),
                success: function(respond) {
                    $("#loadmap").html(respond);
                }
            });
            $("#modal-showmap").modal("show");
        });
    });
</script>
