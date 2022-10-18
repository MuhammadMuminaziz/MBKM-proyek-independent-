@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="modal-title text-center mb-4" id="createCardLabel">Edit Register</h5>
                <form action="/Pasien/{{ $data->id }}" method="post">
                    @method('put')
                    @csrf
                    <input type="hidden" name="slug" value="{{ $data->slug }}">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control shadow-none" id="name" value="{{ old('name', $data->name) }}" required autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Tanggal Lahir</label>
                        <input type="date" name="birthday" class="form-control shadow-none" id="birthday" value="{{ old('birthday', $data->birthday) }}" required>
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
                        <label for="job">Pekerjaan</label>
                        <input type="text" name="job" class="form-control shadow-none" id="job" value="{{ old('job', $data->job) }}" required autocomplete="off">
                    </div>
                    <div class="form-group mb-4">
                        <label for="religion">Agama</label>
                        <input type="text" name="religion" class="form-control shadow-none" id="religion" value="{{ old('religion', $data->religion) }}" required autocomplete="off">
                    </div>
                    <div class="form-group mb-4">
                        <label for="blood">Golongan Darah</label>
                        <input type="text" name="blood" class="form-control shadow-none" id="blood" value="{{ old('blood', $data->blood) }}" required autocomplete="off">
                    </div>
                    <div class="form-group mb-4">
                        <label for="allergy">Alergi Obat</label>
                        <input type="text" name="allergy" class="form-control shadow-none" id="allergy" value="{{ old('allergy', $data->allergy) }}" required autocomplete="off">
                    </div>
                    <div class="form-group mb-4">
                        <label for="address">Alamat</label>
                        <input type="text" name="address" class="form-control shadow-none" id="address" value="{{ old('address', $data->address) }}" required autocomplete="off">
                    </div>
                    <div class="row justify-content-end px-2">
                        <a href="/Pasien" class="btn btn-danger btn-sm mr-1"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Edit Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection