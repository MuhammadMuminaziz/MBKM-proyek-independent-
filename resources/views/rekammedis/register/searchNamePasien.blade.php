<table class="table table-borderless table-sm">
    <tbody>
      @foreach( $data as $dt)
      <tr style="cursor: pointer;">
        <td style="line-height: 6px;"><P class="searchContent" style="z-index: 99;" data-id="{{ $dt->id }}">{{ $dt->name . ' - ' . $dt->address  }}</P></td>
      </tr>
      @endforeach
    </tbody>
</table>

<script>
$(document).ready(function(){
    // value search
    $('.searchContent').on('click', function(){
        let searchValue = $(this).text();
        let id = $(this).data('id');
        $('#searchPasien').val(searchValue);
        $('#pasien_id').val(id);
        $('#pageSearchNamePasien').addClass('d-none');
    });
});
</script>