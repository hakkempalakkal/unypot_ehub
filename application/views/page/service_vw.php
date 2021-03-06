<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-user"></i>&nbsp; <span class="title-page">Service List</span>
      <small>List of data</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Service</a></li>
      <li class="active">List of data</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <table id="tablelist" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width:5%"></th>
                  <th style="width:50%; text-align:left">Service name</th>
                  <th style="width:50%; text-align:left">Description</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<script>
    $(document).ready(function() {
      generateTable();
    });

    function generateTable()
    {   
      var where = "";      
      var table = $('#tablelist').DataTable( {
        ajax: {
          "url": "<?= site_url('ServiceList/bindDatatable')?>",
          "type": "POST",
          "data" : {'where': where}
        }, 
        processing: true, 
        serverSide: true,
        scrollCollapse: true,
        destroy: true,
        iDisplayLength: 10,
        order: [[ 0, "desc" ]],
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> Add New',
                action: function ( e, dt, node, config ) {
                  window.location.href = 'Service';
                }
            }, 
            {
                extend: 'copy',
                text: '<i class="fa fa-copy"></i> Copy',
                exportOptions: {
                    columns: [1,2,3,4,5]
                }
            }, 
            {
                extend: 'excel',
                title: 'Candidate',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                exportOptions: {
                    columns: [1,2,3,4,5]
                }
            }, 
            {
                extend: 'pdf',
                title: 'Candidate',
                text: '<i class="fa fa-file-pdf-o"></i> PDF',
                exportOptions: {
                    columns: [1,2,3,4,5]
                }
            }, 
            {
                extend: 'print',
                title: 'Candidate',
                text: '<i class="fa fa-print"></i> Print',
                exportOptions: {
                    columns: [1,2,3,4,5]
                }
            }
        ],
      });
    }
    
    function reloadDatatable()
    {
      $('#tablelist').DataTable().ajax.reload();
    }

    function generateModalForm(state, row_id) {
      $('#modalForm').modal('show');
      $.ajax({
          type: 'post',
          async: true,
          url: '<?= site_url("user/form") ?>',
          data: {'state': state, 'row_id': row_id},
          success: function(ret) {
              var data = JSON.parse(ret); 
              $('#btnSave').show();
              $('#tableModal').html(data['table']);
          }
      });
    }

    function generateModalView(row_id) {
      $.ajax({
          type: 'post',
          async: true,
          url: '<?= site_url("user/view") ?>',
          data: {'row_id': row_id},
          success: function(ret) {
              var data = JSON.parse(ret); 
              $('#btnSave').hide();
              $('#tableModal').html(data['table']);
          }
      });
    }

    function doSave(){
      var formData = new FormData($('.formInput')[0]);
      
      $.ajax({
        type: 'post',
        async: true,
        url: '<?= site_url("user/save") ?>',
        data: formData,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        success: function(ret) {
          var data = JSON.parse(ret); 
          $('#modalForm').modal('hide');
          reloadDatatable();
          infoStatus("Process successful");
        }
      });
    }

    function doDelete(row_id) {
      bootbox.confirm({
        message: "<span class='alert-txt'><i class='fa fa-question-circle'></i>&nbsp;&nbsp;  Are you sure?<span>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
          if(result == true) {
            $.ajax({
                type: 'post',
                async: true,
                url: '<?= site_url("user/delete") ?>',
                data: {'row_id': row_id},
                success: function(ret) {
                  var data = JSON.parse(ret); 
                  reloadDatatable();
                  infoStatus("Process successful");
                }
            });
          }
        }
      });
    }
</script>