<x-intern-layout-app>
    @section('title', 'Presensi')
    @section('header')
        <style>
            .webcam-capture {
                display: block;
                width: 90vw;
                /* Full viewport width */
                height: 35vh;
                /* Height as a percentage of viewport height */
                margin: auto;
                border-radius: 15px;
                overflow: hidden;
                /* Hide any overflow */
            }

            .webcam-capture video {
                width: 100%;
                height: 100%;
                object-fit: cover;
                /* Ensure the video covers the container */
            }

            #map {
                width: 100vw;
                /* Full viewport width */
                height: 40vh;
                /* Height as a percentage of viewport height */
            }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @endsection

    <x-intern-layout-header judul="Pengajuan Dokumen"></x-intern-layout-header>

    <div class="container mt-1">
        <div class="row">
            <div class="col-12 col-md-6">
                <input type="hidden" id="lokasi" />
                <div class="webcam-capture" id="webcam-capture"></div>
            </div>
        </div>

        <div class="my-3">
            <h3>Lokasi Anda</h3>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="map"></div>
            </div>
        </div>
    </div>

    @push('myscript')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Wait until the DOM is fully loaded
                setTimeout(function() {
                    const webcamCapture = document.getElementById('webcam-capture');

                    // Set webcam dimensions explicitly
                    Webcam.set({
                        image_format: "jpeg",
                        jpeg_quality: 50,
                    });

                    Webcam.attach("#webcam-capture");
                }, 100); // Adjust delay if necessary
            });

            // Function to handle geolocation and map setup
            function setupMapAndGeolocation() {
                var lokasi = document.getElementById("lokasi");
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
                            var map = L.map("map").setView(
                                [position.coords.latitude, position.coords.longitude],
                                16
                            );
                            var location_office = "{{ $loc_office->location_office }}";
                            var loc = location_office.split(",");
                            var lat_office = loc[0];
                            var long_office = loc[1];
                            var radius = "{{ $loc_office->radius }}";
                            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                            }).addTo(map);
                            L.marker([
                                position.coords.latitude,
                                position.coords.longitude,
                            ]).addTo(map);
                            L.circle([lat_office, long_office], {
                                color: "lightgreen",
                                fillColor: "green",
                                fillOpacity: 0.5,
                                radius: radius,
                            }).addTo(map);
                        },
                        function() {
                            // Handle errors
                        }
                    );
                }
            }

            document.addEventListener('DOMContentLoaded', setupMapAndGeolocation);

            // Event handler for presensi button click
            $("#takepresensi, #takepresensi-navbar").click(function(e) {
                Webcam.snap(function(uri) {
                    var image = uri;
                    var lokasi = $("#lokasi").val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('intern.presensi.store') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            image: image,
                            lokasi: lokasi,
                        },
                        cache: false,
                        success: function(respond) {
                            var status = respond.split("|");
                            if (status[0] == "success") {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: status[1],
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    location.href = '{{ route('intern.dashboard') }}';
                                }, 3000);
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: status[1],
                                    icon: "error",
                                });
                            }
                        },
                    });
                });
            });
        </script>
    @endpush
</x-intern-layout-app>
