<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-user"></i>&nbsp; <span class="title-page">Request View</span>
      <small>view</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Request View</a></li>
      <li class="active">Request View</li>
    </ol>
  </section>

  <section class="content">

  <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?=$req->servicename;?>
            <small class="pull-right">Date: <?=$req->RequetedDate;?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong> <?=$req->Fullname;?></strong><br>
            UID: <?=$req->adhaarno;?><br>
            Phone: <?=$req->Phonenumber;?><br>
            Email: <?=$req->EmailID;?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
         
            <tbody>
            <?php foreach($datas as $new) { ?>
            <tr>
              <td><?=$new->field_name;?></td>
              <td> <?php 
              if($new->field_type=="filechooser"){
                echo "<img  style='width: 100%;' src='".$new->field_data."'/>";
              } 
              else{
                echo $new->field_data;
              }
              ?></td>
             
            </tr>
          <?php }?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="../Changestatus/<?=$req->UserRequestID;?>/Rejected"  class="btn btn-danger"><i class="fa fa-print"></i> Reject</a>
          <a href="../Changestatus/<?=$req->UserRequestID;?>/Accepted"  class="btn btn-success"><i class="fa fa-print"></i> Accept</a>
          </button>
        
        </div>
      </div>
    </section>

  </section>
</div>


