<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServiceList extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->table = "services";
        islogin();
    }
    
    public function index() {
		$data = array();
        $this->layout->display('page/service_vw', $data);
    }

    public function bindDatatable()
    {     
        $table = "services";
        $condition = $this->input->post("where");
        $column_order = array('service_id', 'servicename'); 
        $column_search = array(); 
         $order = array('service_id' => 'desc'); 
       $custom_search = array(); 
        $list = $this->datatables->getDatatables2($table, $column_order, $column_search, $order, $custom_search, $condition);
        
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $get) {
			$link = '
				<div class="btn-group">
				  <a href="javascript:void(0)" data-toggle="dropdown" style="color:#111"><i class="fa fa-folder-open"></i></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="definefield/viewss/'.$get->service_id.'" style="color:#111" >View</a></li>
					<li><a href="javascript:void(0)" style="color:#111" onclick="generateModalForm(\'edit\', \''.$get->service_id.'\')">Update</a></li>
					<li><a href="#" style="color:#111" onclick="doDelete(\''.$get->service_id.'\')">Delete</a></li>
				  </ul>
				</div>
			';
            $row = array();
            $row[] = $link;
            $row[] = $get->servicename;
            $row[] = $get->Short_description;
            $row[] = $get->Requiremnts;
            $data[] = $row;
        }

        $output = array(
            "draw" =>'',
            "recordsTotal" => $this->datatables->countAll($table),
            "recordsFiltered" => $this->datatables->countFiltered($table, $column_order, $column_search, $order, $custom_search, $condition),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function view() {
        $row_id = $this->input->post("row_id");
        $user_name = "";
        $full_name = "";
        $role = "";
        
        $condition = "row_id = '".$row_id."'";
        $rs = $this->dataaccess->get("vw_usertable", $condition);
        if($rs != "") {
            $user_name = $rs->user_name;
            $full_name = $rs->full_name;
            $role = $rs->role;
        }        

        $table = '
            <table id="tablelist" class="table table-striped">
              <tbody>
                <tr>
                    <td style="width:25%" class="view-title">Role:</td>
                    <td class="view-txt">'.$role.'</td>
                </tr>
                <tr>
                    <td style="width:25%" class="view-title">Fullname:</td>
                    <td class="view-txt">'.$full_name.'</td>
                </tr>
                <tr>
                    <td style="width:25%" class="view-title">Username:</td>
                    <td class="view-txt">'.$user_name.'</td>
                </tr>
              </tbody>
            </table>
        ';

        $data['table'] = $table;
        echo json_encode($data);
    }

    public function form() {
        $state = $this->input->post("state");
        $row_id = $this->input->post("row_id");
        $user_name = "";
        $full_name = "";
        $role_id = "";

        if($state == "edit") {
            $condition = "row_id = ".$row_id; 
            $rs = $this->dataaccess->get($this->table, $condition);
            if($rs != "") {
                $user_name = $rs->user_name;
                $full_name = $rs->full_name;
                $role_id = $rs->role_id;
            }
        }

        $rs_role = $this->dataaccess->select("sysrole", "1=1");
        $role_list = '';
        if(!empty($rs_role)) {
            foreach($rs_role as $row) {
                $selected = ($row->row_id == $role_id) ? 'selected="selected"' : '';
                $role_list .= '<option value="'.$row->row_id.'"'.$selected.'>'.$row->name.'</option>';
            }
        }

        $table = '
            <div class="row">
            <form method="POST" class="formInput" enctype="multipart/form-data">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Role:</label>
                  <input type="hidden" id="row_id" name="row_id" class="form-control" value="'.$row_id.'" style="background:#fff" readonly />
                  <input type="hidden" id="state" name="state" class="form-control" value="'.$state.'" />
                  <select id="role_id" name="role_id" class="form-control" required>
                    <option value=""></option>
                    '.$role_list.'
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Full name</label>
                  <input type="text" id="full_name" name="full_name" class="form-control" value="'.$full_name.'"/>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>User Name</label>
                  <input type="text" id="user_name" name="user_name" class="form-control" value="'.$user_name.'"/>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" id="pswrd" name="pswrd" class="form-control" />
              </div>
            </form>
            </div>
        ';

        $data['table'] = $table;
        echo json_encode($data);
    }

    public function save()
    {
        $row_id = $this->input->post("row_id");
        $state = $this->input->post("state");
        $full_name = $this->input->post("full_name");
        $user_name = $this->input->post("user_name");
        $pswrd = $this->input->post("pswrd");
        $role_id = $this->input->post("role_id");

        if($state == 'add')
        {
            $insert = array(
                'full_name' => $full_name,
                'user_name' => $user_name,
                'role_id' => $role_id,
                'pswrd' => md5($pswrd)  
            );
            $this->dataaccess->insert($this->table, $insert);
            $data['msg'] = "Process successful";
            echo json_encode($insert);
        }
        else
        {            
            if($pswrd != "") {
                $update = array(
                    'full_name' => $full_name,
                    'user_name' => $user_name,
                    'role_id' => $role_id,
                    'pswrd' => md5($pswrd)          
                );                
            }
            else {
                $update = array(
                    'full_name' => $full_name,
                    'user_name' => $user_name, 
                    'role_id' => $role_id,          
                ); 
            }

            $this->dataaccess->update($this->table, $update, "row_id = '".$row_id."'");
            $data['msg'] = "Process successful";
            echo json_encode($data);
        }
    }

    public function delete(){
        $row_id = $this->input->post("row_id");
        $this->dataaccess->delete($this->table, "row_id = '".$row_id."'");
        $data['msg'] = "Process successful";
        echo json_encode($data);
    }
}	