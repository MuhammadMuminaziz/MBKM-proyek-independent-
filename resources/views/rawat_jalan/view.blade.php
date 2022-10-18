@extends('layouts.main')

@section('content')
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item bg-white" src="/file/rawat_jalan/{{ $data->file }}"></iframe>
</div>
@endsection