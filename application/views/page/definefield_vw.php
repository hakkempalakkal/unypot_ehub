<div class="content-wrapper">
  <section class="content-header">
    <h1><span class="title-page">GENERAL</span></h1>
  </section>

  <section class="content">
    <div class="row">        
      <div class="col-lg-12">
        <form method="POST" class="formGeneral" enctype="multipart/form-data" action="<?= site_url("definefield/savegeneral/") ?><?=$id;?>">
        <table class="table table-bordered table-striped">
          <tbody>
            <tr style="display:none">
              <td style="width:25%">Logo</td>
              <td>
                <img src="<?= base_url("uploaded/".$img_logo) ?>" style="width:100px; height:100px" />
                <div style="clear:both; height:10px"></div>
                <input type="file" id="img_logo" name="img_logo" class="form-control" />
                <input type="hidden" id="img_logo_old" name="img_logo_old" class="form-control" value="<?= $img_logo ?>" />
              </td>
            </tr>
            <tr>
              <td style="width:25%">Page Tittle</td>
              <td><input type="text" id="app_name" name="app_name" class="form-control" value="<?= $app_name ?>" /></td>
            </tr>
            <tr>
              <td style="width:25%">Opening Text</td>
              <td><textarea id="opening_text" name="opening_text" class="form-control"><?= $opening_text ?></textarea></td>
            </tr>
            <tr>
              <td style="width:25%">Closing Text</td>
              <td><textarea id="closing_text" name="closing_text" class="form-control"><?= $closing_text ?></textarea></td>
            </tr>
          </tbody>
        </table>
        <input type="submit" class="btn btn-primary" value="SAVE" />
        </form>
     
      </div>
    </div>
  </section>

  <section class="content">
    <div class="row">    
      <section class="content-header">
        <h1><span class="title-page">DEFINE FIELDS </span></h1>
      </section>
      <div style="clear:both; height:15px"></div>

      <div class="col-lg-12">
        <table id="tablelist" class="table table-bordered table-striped" style="width:100% !important">
          <thead>
            <tr>
              <th style="width:5%"></th>
              <th style="width:25%">Field Name</th>
              <th style="width:25%">Field Type</th>
              <th style="width:35%">Field Option value</th>
              <th style="width:5%">Mandatory</th>
              <th style="width:5%">Seq</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-table"></i> DEFINE FIELDS</h4>
      </div>
      <div class="modal-body">
        <div id="tableModal"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        <button type="button" id="btnSave" class="btn btn-success" onclick="doSave()">SAVE</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
      generateTable();
    });

    function doSearch() {
      generateTable()
    }

    function generateTable() {
      var where = "";  
      datatable = $('#tablelist').DataTable({ 
          "processing": true, 
          "serverSide": true, 
          "paging": false,
          "bDestroy": true,
          "ajax": {
              "url": "<?= site_url('definefield/bindDatatable') ?>",
              "type": "POST",
              "data": {'where': where,'idval':<?=$id;?> }
          },
          dom: 'Bfrtip',
          buttons: [
            {
                text: '<i class="fa fa-plus"></i> Add New',
                action: function ( e, dt, node, config ) {
                    generateModalForm('add', '');
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
          async: false,
          url: '<?= site_url('definefield/form') ?>',
          data: {'state': state, 'row_id': row_id,'idval':<?=$id;?>},
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
          async: false,
          url: '<?= site_url('definefield/view') ?>',
          data: {'row_id': row_id},
          success: function(ret) {
              var data = JSON.parse(ret); 
              $('#btnSave').hide();
              $('#tableModal').html(data['table']);
          }
      });
    }

    /*EDITED UPLOADED*/
    function doSave(){
      var formData = new FormData($('.formInput')[0]);
      var field_name = $('#field_name').val();
      var field_type = $('#field_type').val();
      var field_value = $('#field_value').val();
      var field_mandatory = $('#field_mandatory').val();
      var field_seq = $('#field_seq').val();

      if(field_name == "") {
          infoStatus("Field name must be filled in");
      } else if (field_type == "") {
          infoStatus("Field type must be filled in");
      } else if ((field_type == "CheckBox" || field_type == "Radio Button" || field_type == "Dropdownlist" ) && field_value == "") {
          infoStatus("Field option value must be filled in");
      } else if (field_mandatory == "") {
          infoStatus("Mandatory must be filled in");
      } else if (field_seq == "") {
          infoStatus("Sequence must be filled in");
      } else {
        $.ajax({
          type: 'post',
          async: true,
          url: '<?= site_url('definefield/save') ?>',
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
    }
    /*EDITED UPLOADED*/

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
                async: false,
                url: '<?= site_url('definefield/delete') ?>',
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