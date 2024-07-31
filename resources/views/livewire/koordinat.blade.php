<div>
    <div>
        <div id="map" style="height: 400px;"></div>
        <div class="form-group pt-2">
            <label for="koordinat">Koordinat</label>
            <input type="text" id="titik_koordinat" name="titik_koordinat" class="form-control"
                placeholder="Masukkan koordinat" wire:model="titik_koordinat">
        </div>
        <div class="form-group">
            <label for="radius">Radius</label>
            <input type="text" id="radius" name="radius" class="form-control" placeholder="Masukkan Radius"
                wire:model="radius">
        </div>
        <button type="button" class="btn btn-primary" wire:click="updatekoordinat">Update Map</button>
    </div>
</div>

@push('myscript')
    <script>
        var map = L.map('map').setView([{{ $titik_koordinat }}], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([{{ $titik_koordinat }}]).addTo(map);
        var circle = L.circle([{{ $titik_koordinat }}], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: {{ $radius }}
        }).addTo(map);
    </script>
@endpush
