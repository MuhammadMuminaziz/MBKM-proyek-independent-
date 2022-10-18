<table class="table table-borderless table-sm">
    <tbody>
      @foreach( $data as $dt)
      <tr style="cursor: pointer;">
        <td style="line-height: 6px;"><P class="searchContentPasien" style="z-index: 99;">{{ $dt->nama_obat }}</P></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <script>
    $(document).ready(function(){
      // value search
      $('.searchContentPasien').on('click', function(){
          let searchValue = $(this).text();
          $('.searchObatPasien').val(searchValue);
          $('.pageObatPasien').addClass('d-none');
        });
    });
  </script>