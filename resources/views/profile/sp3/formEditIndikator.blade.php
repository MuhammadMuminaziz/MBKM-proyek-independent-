<form action="/profile/sp3/edit-indikator" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="modal-body">
        <div class="form-group">
            <label for="pelayanan">Pelayanan Dasar</label>
            <input type="text" class="form-control form-control-sm" name="pelayanan" id="pelayanan" aria-describedby="emailHelp" value="{{ $data->pelayanan }}" required>
        </div>
        <div class="form-group">
            <label for="file">Pilih File</label>
            <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Update</button>
    </div>
</form>