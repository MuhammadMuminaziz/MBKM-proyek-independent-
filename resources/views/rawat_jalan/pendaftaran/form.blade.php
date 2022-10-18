<form action="/rawat-jalan/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="menu" value="pendaftaran">
    <div class="modal-body">
        <div class="form-group">
            <label for="method">Metode</label>
            <select class="form-control form-control-sm" id="method" name="method">
                <option>Umum</option>
                <option>BPJS</option>
            </select>
        </div>
        <div class="form-group">
            <label for="file">File</label>
            <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
    </div>
</form>