<form action="/profile/laporan-tahunan/upload" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="type">Petugas</label>
            <input type="text" name="type" id="type" class="form-control form-control-sm">
        </div>
        <div class="form-group">
            <label for="file">Pilih File</label>
            <input type="file" class="form-control-file" id="file" name="file" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
    </div>
</form>