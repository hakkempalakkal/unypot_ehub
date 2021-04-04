<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url("assets/dashtemp") ?>/dist/img/user.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>E-hub</p>
        <a href="#"><i class="fa fa-building"></i> Admin User</a>
      </div>
    </div>

    <ul class="sidebar-menu">
      <li class="header">MENU</li>
      <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Requestes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> New Request</a></li>
            <li ><a href="index2.html"><i class="fa fa-circle-o"></i> Pending</a></li>
            <li ><a href="index2.html"><i class="fa fa-circle-o"></i> Completed</a></li>
            <li ><a href="index2.html"><i class="fa fa-circle-o"></i> Rejected</a></li>
          </ul>
        </li>

        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Service Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url("ServiceList") ?>"><i class="fa fa-circle-o"></i> Service List</a></li>
            <li><a href="ServiceList"><i class="fa fa-circle-o"></i> Create Service</a></li>
          </ul>
        </li>
     
      <!-- <li><a href="<?= site_url("dataform") ?>"><i class="fa fa-table"></i> Data inputted</a></li> -->
      <li><a href="<?= site_url("user") ?>"><i class="fa fa-user"></i> User Backend</a></li>
      <li><a href="<?= site_url("login/logout") ?>"><i class="fa fa-power-off"></i> Logout</a></li>
    </ul>
  </section>
</aside>