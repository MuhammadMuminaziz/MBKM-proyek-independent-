@extends('layouts.main')

@section('content')
<div class="card p-3">
    <h3>Input Data Obat</h3>
    <table class="table table-sm table-bordered" id="table1">
        <thead>
          <tr class="text-center">
            <th width="50px">No</th>
            <th width="50%">Nama Obat</th>
            <th width="40%">Jenis Obat</th>
            <th width="50px"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">1</td>
            <td contenteditable="true" class="nama_obat"></td>
            <td contenteditable="true" class="jenis"></td>
            <td class="text-center">
                {{-- <button class="btn btn-sm btn-danger" id="hapus"><i class="fa fa-minus"></i></button> --}}
            </td>
          </tr>
        </tbody>
    </table>
    <div class="row justify-content-between p-2">
        <a href="/rawat-jalan/parmasi/daftar-obat"><button class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Kembali</button></a>
        <div class="row">
            <button class="btn btn-sm btn-success" id="tambah"><i class="fa fa-plus"></i></button>
            <button class="btn btn-sm btn-primary mx-1" id="simpan">Simpan</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        let baris = 1;
        $(document).on('click', '#tambah', function(){
            baris = baris + 1;
            var html = `<tr id="baris${ baris }">
                            <td class="text-center">${ baris }</td>
                            <td contenteditable="true" class="nama_obat"></td>
                            <td contenteditable="true" class="jenis"></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger rounded-circle" data-row="baris${baris}" id="hapus"><i class="fa fa-minus"></i></button>
                            </td>
                        </tr>"`;
            $('#table1').append(html);
        })

        $(document).on('click', '#hapus', function(){
            let hapus = $(this).data('row');
            $('#' + hapus).remove();
        })
        
        $(document).on('click', '#simpan', function(){
            let nama_obat = [];
            let jenis = [];

            $('.nama_obat').each(function(){
                nama_obat.push($(this).text());
            })
            $('.jenis').each(function(){
                jenis.push($(this).text());
            })

            $.ajax({
                url: "{{ url('/rawat-jalan/parmasi/tambah-obat') }}",
                type: 'post',
                data: {
                    nama_obat, jenis, "_token": "{{ csrf_token() }}"
                },
                success: function(res){
                    window.location.replace('/rawat-jalan/parmasi/daftar-obat');
                },
                error: function(xhr){
                    console.log(xhr);
                }
            })
        })


    })
</script>
@endsection
