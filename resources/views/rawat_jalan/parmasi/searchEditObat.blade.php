<table class="table table-borderless table-sm">
    <tbody>
      @foreach( $data as $dt)
      <tr style="cursor: pointer;">
        <td style="line-height: 6px;"><P class="searchContentEditObat" style="z-index: 99;">{{ $dt->nama_obat }}</P></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <script>
    $(document).ready(function(){
      // value search
      $('.searchContentEditObat').on('click', function(){
          let searchValue = $(this).text();
          $('.searchEditObat').val(searchValue);
          $('.pageObatEdit').addClass('d-none');
        });
    });
  </script>