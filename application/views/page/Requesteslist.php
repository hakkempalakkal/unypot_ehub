<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-user"></i>&nbsp; <span class="title-page">New Requestes</span>
      <small>List of data</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> New Requestes</a></li>
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
                 
                  <th style="text-align:left">Request No</th>
                  <th style=" text-align:left">Service Name</th>
                  <th style=" text-align:left">Requestes Date</th>
                  <th style=" text-align:left">Request From</th>
                  <th style=" text-align:left">Adhaar</th>
                  <th style=" text-align:left">Mobile No</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($datas as $new) { ?>
              <tr>
                 
                  <td style="text-align:left"><?=$new->UserRequestID;?></td>
                  <td style=" text-align:left"><?=$new->servicename;?></td>
                  <td style=" text-align:left"><?=$new->RequetedDate;?></td>
                  <td style=" text-align:left"><?=$new->Fullname;?></td>
                  <td style=" text-align:left"><?=$new->adhaarno;?></td>
                  <td style=" text-align:left"><?=$new->Phonenumber;?></td>
                  <td style=" text-align:left"><a href="Requestes/View/<?=$new->UserRequestID;?>" >View </a></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


