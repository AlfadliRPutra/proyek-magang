<style>
    #map {
        height: 260px;
        width: 100%;
    }
</style>
<div id="map"></div>
<script>
    $(document).ready(function() {
        var presensiLocation = "{{ $presensi->location_in }}";
        var locationParts = presensiLocation.split(",");
        var latitude = parseFloat(locationParts[0]);
        var longitude = parseFloat(locationParts[1]);

        // Initialize the vector map
        var map = new jsVectorMap({
            map: 'world',
            selector: '#map',
            zoomButtons: true,
            zoomOnScroll: false,
            markers: [{
                coords: [latitude, longitude],
                name: "{{ $presensi->name }}"
            }]
        });

        // Optional: Add any additional configurations or interactions
    });
</script>
