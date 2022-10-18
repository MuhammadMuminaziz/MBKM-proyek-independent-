@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="modal-title text-center mb-4" id="createCardLabel">Edit Kartu Rekam Medis</h5>
                <form action="/Kartu-RM/{{ $data->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama KK</label>
                        <input type="text" name="name" class="form-control shadow-none" id="name" value="{{ old('name', $data->name) }}" required autofocus autocomplete="off">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="code_ds">Kode Desa</label>
                            <input type="number" class="form-control" name="code_ds" id="code_ds" value="{{ old('code_ds', $data->code_ds) }}" required autocomplete="off">
                        </div>
                        <div class="col">
                            <label for="age">Umur</label>
                            <input type="number" class="form-control" name="age" id="age" value="{{ old('age', $data->age) }}" required autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3 px-2 flex-column">
                        <label for="gender">Jenis Kelamin</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="gender" value="laki-laki" id="laki-laki" {{ ($data->gender === 'laki-laki') ? 'checked' : '' }}>
                            <label for="laki-laki" class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="gender" value="perempuan" id="perempuan" {{ ($data->gender === 'perempuan') ? 'checked' : '' }}>
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="address">Alamat</label>
                        <input type="text" name="address" class="form-control shadow-none" id="address" value="{{ old('name', $data->address) }}" required autocomplete="off">
                    </div>
                    <div class="row justify-content-end px-2">
                        <a href="/Kartu-RM" class="btn btn-danger btn-sm mr-1"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Edit kartu Rekam Medis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection