<form action="/rawat-inap/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    <div class="modal-body">
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