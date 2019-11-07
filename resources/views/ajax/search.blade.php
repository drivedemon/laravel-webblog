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
  var page = 1
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
    page = 1
    fetch_data(query)
  })

  $(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() && $('#search').val() != '') {
      page++
      var s = $('#search').val()
      fetch_data(s, page)
    }
  })

  function fetch_data(query = '', page = '') {
    $.ajax({
      url: "{{route('search.action')}}",
      method: 'GET',
      data: {query:query,page:page},
      dataType: 'json',
      beforeSend:function() {
        $('.loading').show()
      }
    }).done(function(data) {
      if (data.table_data.length == 0) {
        if (page == '') {
          $('tbody').html("<tr><td align='center' colspan='5'>ไม่พบข้อมูล</td></tr>")
          $('.loading').hide()
          return
        }
        $('.loading').html('<b>ไม่พบข้อมูลเพิ่มเติม</b>')
        return
      }
      $('.loading').hide()
      if (page != '') {
        $('tbody').append(data.table_data)
        $('#total').text(data.total_data)
      } else {
        $('tbody').html(data.table_data)
        $('#total').text(data.total_data)
      }
    })
  }
</script>
