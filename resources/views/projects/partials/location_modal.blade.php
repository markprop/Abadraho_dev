<div class="modal addressModal bd-example-modal-xl" id="addressModal" tabindex="-1" role="dialog"
     style="padding-top: 2%;" data-project-latitude="{{ $project->latitude ?? 24.8607 }}" data-project-longitude="{{ $project->longitude ?? 67.0011 }}">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Location</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12" id="map-modal" style="height: 450px; border-radius: 8px;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Optional: Add buttons if needed -->
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Add Mapbox CSS and JS -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            mapboxgl.accessToken = '{{ env('MAPBOX_ACCESS_TOKEN') }}';

            // Get lat/lng from data attributes
            var modal = document.getElementById('addressModal');
            var lat = parseFloat(modal.dataset.projectLatitude);
            var lng = parseFloat(modal.dataset.projectLongitude);

            if (isNaN(lat) || isNaN(lng)) {
                lat = 24.8607; // Karachi latitude
                lng = 67.0011; // Karachi longitude
                console.log('Invalid latitude or longitude, using fallback: Karachi as of 2025-09-03 13:41 PKT');
            }

            // Initialize map
            var map = new mapboxgl.Map({
                container: 'map-modal',
                style: 'mapbox://styles/mapbox/streets-v12',
                center: [0, 0], // Start off-screen for animation
                zoom: 2,
                pitch: 0,
                bearing: 0
            });

            // Add controls
            map.addControl(new mapboxgl.NavigationControl({ showCompass: true }));
            map.addControl(new mapboxgl.GeolocateControl({
                positionOptions: { enableHighAccuracy: true },
                trackUserLocation: true
            }));

            // Fly to location on load
            map.on('load', function () {
                map.flyTo({
                    center: [lng, lat],
                    zoom: 14,
                    pitch: 45,
                    bearing: 20,
                    speed: 0.8,
                    curve: 1.2,
                    easing: function (t) { return t; }
                });

                // Add animated marker
                var marker = new mapboxgl.Marker({
                    color: '#ec1c24',
                    scale: 1.0
                })
                .setLngLat([lng, lat])
                .setPopup(new mapboxgl.Popup().setHTML('<h3>{{ $project->name ?? "Project Location" }}</h3><p>{{ $project->address ?? "Address not available" }}</p>'))
                .addTo(map);

                // Pulse animation
                function animateMarker(timestamp) {
                    var scale = 1.0 + Math.sin(timestamp / 200) * 0.1;
                    marker.setScale(scale);
                    requestAnimationFrame(animateMarker);
                }
                requestAnimationFrame(animateMarker);
            });

            // Handle errors
            map.on('error', function (e) {
                console.error('Map error:', e.error);
            });
        });
    </script>
    @endpush