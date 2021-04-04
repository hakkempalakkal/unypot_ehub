<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-user"></i>&nbsp; <span class="title-page">Service</span>
      <small>Manage Service</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Service</a></li>
      <li class="active">Create Service</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
    <div class="col-md-12">
    <div class="box box-primary">
            <div class="box-header with-border">
        
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"  method="post" action="<?php echo site_url('Service/post');?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Service Name</label>
                  <input type="text" class="form-control" name="service_name"  placeholder="Enter Service Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Short Description</label>
                  <textarea class="form-control" name="short_description" rows="3" placeholder="Enter ..."></textarea>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Requiremnts  </label>
                  <textarea class="form-control" name="Requiremnts" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Documents_required  </label>
                  <textarea class="form-control" name="Documents_required" rows="3" placeholder="Enter ..."></textarea>
                </div>
                  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div></div>
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


