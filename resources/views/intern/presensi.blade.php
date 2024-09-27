<x-intern-layout-app>
    <header
        class="bg-white text-dark py-2 px-3 d-flex justify-content-between align-items-center shadow-sm rounded-bottom"
        style="border-bottom: 1px solid #ddd;">
        <div class="d-flex align-items-center" style="width: 20px;">
            <a href="{{ route('intern.dashboard') }}" class="btn btn-link text-dark p-0">
                <i class="fas fa-chevron-left" style="font-size: 12px;"></i>
            </a>
        </div>
        <div class="flex-grow-3 d-flex justify-content-center align-items-center">
            <span style="font-size: 16px; font-weight: 600; letter-spacing: 0.85px;">Presensi</span>

        </div>
        <div class="d-flex align-items-center" style="width: 20px;">
            <!-- Ikon kanan atau div kosong -->
        </div>
    </header>


    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 d-flex justify-content-center mx-2">
                <input type="hidden" id="lokasi" />
                <!-- Bordered Container for Webcam Capture -->
                <div class="border rounded p-3"
                    style="width: 100%; max-width: 500px; overflow: hidden; border: 2px solid #f44336;">
                    <!-- Red for Telkom -->
                    <div class="webcam-capture" id="webcam-capture" style="width: 100%; height: 350px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3 text-center mx-3">
            <div class="fs-4 fw-bold" style="color: #0077b6;"> <!-- Blue for PAN -->
                <i class="fas fa-map-marker-alt"></i> Lokasi Anda
            </div>
        </div>

        <div class="row justify-content-center mx-3">
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <!-- Bordered Container for Map -->
                <div class="border rounded p-3"
                    style="width: 100%; max-width: 500px; overflow: hidden; border: 2px solid #4caf50;">
                    <!-- Green for Akhlak BUMN -->
                    <div id="map" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>






    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('myscript')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Wait until the DOM is fully loaded
                setTimeout(function() {
                    const webcamCapture = document.getElementById('webcam-capture');

                    // Set webcam dimensions explicitly with px
                    Webcam.set({
                        width: webcamCapture.offsetWidth, // Get width from the container
                        height: webcamCapture.offsetHeight, // Get height from the container
                        image_format: "jpeg",
                        jpeg_quality: 50,
                    });

                    Webcam.attach("#webcam-capture");
                }, 100); // Adjust delay if necessary
            });

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
                            L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
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
                @if (is_null($goalExists))
                    // Redirect to goals route if $goalExist is null
                    window.location.href = "{{ route('intern.goals') }}";
                @else
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
                            }
                        });
                    });
                @endif
            });
        </script>
    @endpush
</x-intern-layout-app>
