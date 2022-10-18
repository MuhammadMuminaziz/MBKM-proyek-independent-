@extends('layouts.main')

@section('content')
{{-- Data Pasien --}}
<div class="card p-2">
    <div class="row flex-column px-2 mb-3">
        <h4 class="m-2">Total Pengeluaran Obat {{ $type }}</h4>
        <div class="row px-2">
            <div class="col-md-6">
                <form action="/rawat-jalan/parmasi/print/filter-pengeluaran-obat" target="_black">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control form-control-sm" name="tahun" id="tahunObatParmasi">
                                @foreach ($tahun as $y)
                                    <option {{ ($y->year == date('Y')) ? 'selected' : '' }}>{{ $y->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-control-sm" name="bulan" id="bulanObatParmasi">
                                @foreach($bulan as $b)
                                    <option value="{{ $b->moon }}" {{ ($b->moon == date('m')) ? 'selected' : '' }}>{{ $b->bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-primary" id="btnFilterObatParmasi" data-type="{{ $type }}">Filter</button>
                            <button type="submit" class="btn btn-sm btn-primary m-0"><i class="fa fa-download"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col px-2 mb-3" id="pageFilterObatParmasi">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" width="50px">No</th>
                        <th scope="col">Obat</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Jumblah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->nama_obat }}</td>
                        <td>{{ $dt->jenis }}</td>
                        <td>{{ $dt->daftarObat->where('type', $type)->sum('jumblah_obat') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="/rawat-jalan/parmasi"><button class="btn btn-sm btn-danger mb-2 mx-2"><i class="fa fa-arrow-left"></i> Kembali</button></a>
    </div>
</div>

<script>
    $(document).ready(function(){

        // Filter
        $('#btnFilterObatParmasi').on('click', function(){
            let tahun = $('#tahunObatParmasi').val();
            let bulan = $('#bulanObatParmasi').val();
            let type = $('#btnFilterObatParmasi').data('type');
            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/filter-obat-parmasi') }}",
                type: 'get',
                data: {tahun, bulan, type},
                success:function(data){
                    $('#pageFilterObatParmasi').html(data);
                }
            })
        })
    })
</script>
@endsection