<div class="card shadow-sm border-0 p-4">
    <h3 class="text-center mb-4">Lokasi Sekolah</h3>
    <div id="map" style="height: 300px; border-radius: 8px;" wire:ignore></div>
    <div class="mt-3">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control"
                            placeholder="Masukkan Latitude" wire:model="latitude">
                    </div>
                    <div class="col-md-6">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control"
                            placeholder="Masukkan Longitude" wire:model="longitude">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="radius" class="form-label">Radius Maksimum</label>
                <input type="text" id="radius" name="radius" class="form-control" placeholder="Masukkan Radius"
                    wire:model="radius">
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Lokasi</button>
        </form>
    </div>
</div>

@push('myscript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let map, marker, circle;
            let isMapInitialized = false;

            function initMap(lat, lng, rad) {
                if (!isMapInitialized) {
                    map = L.map("map").setView([lat, lng], 13);
                    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    marker = L.marker([lat, lng]).addTo(map);
                    circle = L.circle([lat, lng], {
                        color: "red",
                        fillColor: "#f03",
                        fillOpacity: 0.5,
                        radius: rad
                    }).addTo(map);

                    isMapInitialized = true;

                    setTimeout(() => map.invalidateSize(), 500);
                }
            }

            function updateMap(lat, lng, rad) {
                marker.setLatLng([lat, lng]);
                circle.setLatLng([lat, lng]);
                circle.setRadius(rad);
                map.setView([lat, lng], 13);

                setTimeout(() => map.invalidateSize(), 100);
            }

            Livewire.on("lokasi-updated", (data) => {
                let eventData = Array.isArray(data) ? data[0] : data;

                if (eventData) {
                    let lat = parseFloat(eventData.latitude);
                    let lng = parseFloat(eventData.longitude);
                    let rad = parseFloat(eventData.radius);

                    updateMap(lat, lng, rad);
                }
            });

            try {
                initMap(
                    parseFloat("{{ $latitude }}"),
                    parseFloat("{{ $longitude }}"),
                    parseFloat("{{ $radius }}")
                );
            } catch (error) {
                initMap(-6.2088, 106.8456, 1000);
            }
        });
    </script>
@endpush
