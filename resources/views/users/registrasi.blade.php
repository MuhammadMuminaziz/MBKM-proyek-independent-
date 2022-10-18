@extends('layouts.main')

@section('content')
{{-- message --}}
<div id="message" data-message="{{ session('success') }}"></div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <h5 class="card-header">Registrasi</h5>
            <div class="card-body">
                <form action="/registrasi" method="post">
                    @csrf
                    <input type="hidden" name="photo" value="default.png">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="name" placeholder="masukan nama lengkap" required autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required autocomplete="off" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Petugas</label>
                        <select class="form-control form-control-sm" id="type" name="type">
                            <option value="Profile" {{ (old('type') == 'Profile' ? "selected" : " ") }}>Profile</option>
                          <option value="Rekam Medis" {{ (old('type') == 'Rekam Medis' ? "selected" : " ") }}>Rekam Medis</option>
                          <option value="Rawat Jalan" {{ (old('type') == 'Rawat Jalan' ? "selected" : " ") }}>Rawat Jalan</option>
                          <option value="Rawat Inap" {{ (old('type') == 'Rawat Inap' ? "selected" : " ") }}>Rawat Inap</option>
                          <option value="Administrator" {{ (old('type') == 'Administrator' ? "selected" : " ") }}>Administrator</option>
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" id="password" placeholder="masukan password" required autocomplete="off">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary mx-1">Buat Akun Baru</button>
                        <a href="/dashboard/users" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // sweetalert
        let message = $('#message').data('message');
        if(message){
            Swal.fire(
                '',
                message,
                'success'
            )
        }
    })
</script>
@endsection