<div>
    <h3 class="title-5 m-b-25">Waktu Absen</h3>
    <div class="form-group">
        <label for="jam_masuk">Jam Masuk</label>
        <input type="time" id="jam_masuk" name="jam_masuk" class="form-control" wire:model="jam_masuk">
    </div>
    <div class="form-group">
        <label for="batas_jam_masuk">Batas Jam Masuk</label>
        <input type="time" id="batas_jam_masuk" name="batas_jam_masuk" class="form-control" wire:model="batas_jam_masuk">
    </div>
    <div class="form-group">
        <label for="jam_pulang">Jam Pulang</label>
        <input type="time" id="jam_pulang" name="jam_pulang" class="form-control" wire:model="jam_pulang">
    </div>
    <div class="form-group">
        <label for="batas_jam_pulang">Batas Jam Pulang</label>
        <input type="time" id="batas_jam_pulang" name="batas_jam_pulang" class="form-control" wire:model="batas_jam_pulang">
    </div>
    <button type="button" class="btn btn-primary" wire:click="updatejam">Update Waktu Absen</button>
</div>
