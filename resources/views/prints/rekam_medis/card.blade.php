<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    @page{
      margin: 0;
    }
    .theads {
      text-align: left;
      width: 130px;
    }
    .theads, td{
      vertical-align: top;
    }
    .family{
      border-bottom: 1px solid black;
    }
  </style>
</head>
<body style="padding: 10px 10px 10px 10px; border: 2px solid black; overplow: hidden">
    <div>
      <div>
        <img src="{{ asset('img/prints/KOOP.jpg') }}" style="width: 100%" alt="">
      </div>
      <h5 style="text-align: center; margin: 0px;">KARTU TANDA PENGENAL KELUARGA</h5>
      <div style="padding: 10px;">
        <div>
          <small>
            <table width="100%">
              <tr>
                <td class="theads">No. RM/Kode Desa</td>
                <td>:</td>
                <td>{{ $data->no_rm . '/' . $data->code_ds }}</td>
              </tr>
              <tr>
                <td class="theads">Nama KK</td>
                <td>:</td>
                <td>{{ $data->name }}</td>
              </tr>
              <tr>
                <td class="theads">Umur</td>
                <td>:</td>
                <td>{{ $data->age }} Tahun</td>
              </tr>
              <tr>
                <td class="theads">Alamat</td>
                <td>:</td>
                <td>{{ $data->address }}</td>
              </tr>
            </table>
          </small>
          <h4 style="text-align: center; margin-bottom: 10px;">Anggota Keluarga</h4>
          <div style="padding: 0 10px;">
            <small>
              <table width="100%" style="border-collapse: collapse;">
                @foreach($data->pasien->skip(1) as $dt)
                <tr>
                  <td class="family" style="width: 20px;">{{ $loop->iteration }}</td>
                  <td class="family">{{ $dt->name }}</td>
                </tr>
                @endforeach
              </table>
            </small>
          </div>
        </div>
      </div>
    </div>
</body>
</html>