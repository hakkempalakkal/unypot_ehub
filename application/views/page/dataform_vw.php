<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-table"></i>&nbsp; <span class="title-page">DATA FORM</span>
      <small>List of Data</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-table"></i> Data Form</a></li>
      <li class="active">List of data</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">      
      <div class="col-xs-12">
        <?php
          if($count_field > 0) {
        ?>
        <table id="tablelist" class="table table-bordered table-striped" style="width:100% !important">
          <thead>
            <tr>
              <?php
                if(!empty($dynamicfield_list)) {
                  foreach($dynamicfield_list as $row) {
                    echo '<th>'.$row->field_name.'</th>';
                  }
                }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
              if(!empty($dataform_list)) {
                $current_column = 0;
                $form_id = "";
                foreach($dataform_list as $row) {
                    if($form_id != $row->form_id) {
                      $form_id = $row->form_id;
                      if($current_column == 0) {
                        echo '<tr>';  
                      } else {
                        if($current_column < $count_field) {
                          $loop = $count_field - $current_column;
                          for($x=1; $x<=$loop; $x++) {
                            echo '<td></td>';
                          }
                        }
                        echo '</tr><tr>'; 
                        $current_column = 0; 
                      }                   
                    }

                    if($current_column < $count_field) {
                      echo '<td>'.$row->field_data.'</td>';
                    }

                    $current_column++;
                }
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
        <?php
          }
        ?>
      </div>
    </div>
  </section>
</div>

<script>
    $(document).ready(function() {
      $('#tablelist').DataTable( {
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'dashboard',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                exportOptions: {
                    columns: [
                      <?php
                        $arr = "";
                        for($i=0; $i<$count_field; $i++) {
                          if($i == 0) {
                            $arr = $i;
                          } else {
                            $arr .= ','.$i; 
                          }
                        }
                        echo $arr;
                      ?>
                    ]
                }
            }
        ],
      });
    });
  </script>