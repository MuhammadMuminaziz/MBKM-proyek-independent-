<div class="modal-header">
    <h5 class="modal-title" id="modalEditObatLabel">Edit Obat</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="/rawat-jalan/parmasi/edit-obat" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="modal-body">
        <div class="form-group row">
            <label for="nama_obat" class="col-sm-3 col-form-label">Nama Obat</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="nama_obat" id="nama_obat" value="{{ $data->nama_obat }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="jenis" class="col-sm-3 col-form-label">Jenis Obat</label>
            <div class="col-sm-9">
                <select class="form-control" id="jenis" name="jenis">
                    <option {{ ($data->jenis == 'Tablet') ? 'selected' : '' }}>Tablet</option>
                    <option {{ ($data->jenis == 'Sirup') ? 'selected' : '' }}>Sirup</option>
                    <option {{ ($data->jenis == 'Kapsul') ? 'selected' : '' }}>Kapsul</option>
                    <option {{ ($data->jenis == 'Tabur') ? 'selected' : '' }}>Tabur</option>
                    <option {{ ($data->jenis == 'Salep') ? 'selected' : '' }}>Salep</option>
                    <option {{ ($data->jenis == 'Cairan') ? 'selected' : '' }}>Cairan</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Edit</button>
    </div>
</form>
