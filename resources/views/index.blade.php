@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col">
        <div class="card p-2">
            <h1 class="text-center">Hallo {{ auth()->user()->name }} <br>Selamat Datang di Puskesmas Pabedilan...</h1>
        </div>
    </div>
</div>
@endsection