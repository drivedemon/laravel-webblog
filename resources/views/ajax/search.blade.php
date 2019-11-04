<div class="form-group row">
  <div class="col-md-1">
  </div>
  <div class="col-md-10">
    <input type="text" class="form-control" id="search" name="search" placeholder="&#xf002; ค้นหาข้อมูล">
  </div>
  <div class="col-md-1">
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    fetch_data()
  })

  $(document).on('submit', '.delete_form', function() {
    if (confirm('ต้องการลบข้อมูลใช่ไหม')) {
      return true;
    } else {
      return false;
    }
  })

  $(document).on('keyup', '#search', function() {
    var query = $(this).val()
    fetch_data(query)
  })

  function fetch_data(query = '') {
    $.ajax({
      url: "{{route('search.action')}}",
      method: 'GET',
      data: {query:query},
      dataType: 'json',
      success: function(data) {
        $('tbody').html(data.table_data)
        $('#total').text(data.total_data)
      }
    })
  }
</script>
