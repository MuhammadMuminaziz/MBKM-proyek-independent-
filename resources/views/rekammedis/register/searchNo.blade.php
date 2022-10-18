<table class="table table-borderless table-sm">
    <tbody>
      @foreach( $data as $rm)
      <tr style="cursor: pointer;">
        <td style="line-height: 6px;"><P class="searchContent" style="z-index: 99;">{{ $rm->no_rm . ' ' . $rm->name . ' ' . $rm->address }}</P></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <script>
    $(document).ready(function(){
      // value search
      $('.searchContent').on('click', function(){
          let searchValue = $(this).text();
          $('#searchNoRegister').val(searchValue);
          $('#pageNoRm').addClass('d-none');
        });
    });
  </script>