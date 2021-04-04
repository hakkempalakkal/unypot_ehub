<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Definefield extends CI_Controller {
    private $table;

    function __construct() {
        parent::__construct();
        $this->table = "dynamicfield";
        islogin();
    }
    
    public function index() {
        $app_name = "";
        $opening_text = "";
        $closing_text = "";
        $img_logo = "";
        
        $rs = $this->dataaccess->get($this->table, "1=1");
        if(!empty($rs)) {
            $img_logo = $rs->img_logo;
            $app_name = $rs->app_name;
            $opening_text = $rs->opening_text;
            $closing_text = $rs->closing_text;
        }
		$data = array(
            'img_logo' => $img_logo,
            'app_name' => $app_name,
            'opening_text' => $opening_text,
            'closing_text' => $closing_text,
        );
        $this->layout->display('page/definefield_vw', $data);
    }

    public function viewss($id=0) {
        $app_name = "";
        $opening_text = "";
        $closing_text = "";
        $img_logo = "";
        
        $rs = $this->dataaccess->get($this->table, "service_id=".$id);
        if(!empty($rs)) {
            $img_logo = $rs->img_logo;
            $app_name = $rs->app_name;
            $opening_text = $rs->opening_text;
            $closing_text = $rs->closing_text;
        }
		$data = array(
            'img_logo' => $img_logo,
            'app_name' => $app_name,
            'opening_text' => $opening_text,
            'closing_text' => $closing_text,
            'id'=>$id
        );
        $this->layout->display('page/definefield_vw', $data);
    }

    public function bindDatatable()
    {       
        $table = $this->table;
        
       
        $idval = $this->input->post("idval");
        $condition="service_id=".$idval;
        $column_order = array('field_seq', 'field_name','field_value','field_type','field_mandatory','field_seq'); 
        $column_search = array('row_id', 'field_name','field_value','field_type','field_mandatory','field_seq'); 
        $order = array('field_seq' => 'desc'); 
        $custom_search = array('row_id', 'field_name','field_value','field_type','field_mandatory','field_seq'); 
        $list = $this->datatables->getDatatables2($table, $column_order, $column_search, $order, $custom_search, $condition);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $get) {
            $link = '
                <div class="btn-group">
                  <a href="javascript:void(0)" data-toggle="dropdown" style="color:#111"><i class="fa fa-folder-open"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" style="color:#111" data-toggle="modal" data-target="#modalForm" onclick="generateModalView(\''.$get->row_id.'\')">View</a></li>
                    <li><a href="javascript:void(0)" style="color:#111" onclick="generateModalForm(\'edit\', \''.$get->row_id.'\')">Update</a></li>
                    <li><a href="#" style="color:#111" onclick="doDelete(\''.$get->row_id.'\')">Delete</a></li>
                  </ul>
                </div>
            ';
            $row = array();
            $row[] = $link;
            $row[] = $get->field_name;
            $row[] = $get->field_type;
            $row[] = $get->field_value;
            $row[] = $get->field_mandatory;
            $row[] = $get->field_seq;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables->countAll($table),
            "recordsFiltered" => $this->datatables->countFiltered($table, $column_order, $column_search, $order, $custom_search, $condition),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function savegeneral($id=0)
    {
        $app_name = $this->input->post("app_name");
        $opening_text = $this->input->post("opening_text");
        $closing_text = $this->input->post("closing_text");
        $file_name = $this->input->post("img_logo_old"); 

        if($_FILES['img_logo']['name'] != '')
        {
             $ext = pathinfo($_FILES['img_logo']['name'], PATHINFO_EXTENSION);
             $file_name = date("YmdHis").".".$ext;
             $config = array(
                'upload_path' => 'uploaded',
                'allowed_types' => 'jpg|png|jpeg',
                'overwrite' => TRUE,
                'file_name' =>  $file_name
            );
            $this->upload->initialize( $config);
            if( $this->upload->do_upload('img_logo'))
            {
                $upload = $this->upload->data();
            }
        }

        $update = array(
            'app_name' => $app_name,
            'opening_text' => $opening_text,
            'closing_text' => $closing_text,
            'img_logo' => $file_name,             
        );
        $this->dataaccess->update($this->table, $update, "service_id=".$id);
        redirect(site_url("definefield"));
    }

    public function save()
    {
        $state = $this->input->post("state");
        $row_id = $this->input->post("row_id");
        $field_name = $this->input->post("field_name");
        $field_value = $this->input->post("field_value");
        $field_type = $this->input->post("field_type");
        $field_mandatory = $this->input->post("field_mandatory");
        $field_seq = $this->input->post("field_seq");
        $app_name = $this->input->post("app_name");
        $opening_text = $this->input->post("opening_text");
        $closing_text = $this->input->post("closing_text");
        $img_logo = $this->input->post("img_logo");
        $id = $this->input->post("hdnval");
        if($field_type == "Label" || $field_type == "Label Bold" || $field_type == "Title") {
           $field_mandatory = "No"; 
        }

        if($state == 'add')
        {
            $insert = array(
                'field_name' => $field_name,
                'field_value' => $field_value,
                'field_type' => $field_type, 
                'field_mandatory' => $field_mandatory,
                'field_seq' => $field_seq,  
                'app_name' => $app_name,
                'opening_text' => $opening_text,
                'closing_text' => $closing_text,
                'img_logo' => $img_logo, 
                'service_id' =>   $id
            );
            $this->dataaccess->insert($this->table, $insert);
            $data['msg'] = "Process successful";
            echo json_encode($data);
        }
        else
        {            
            $update = array(
                'field_name' => $field_name,
                'field_value' => $field_value,
                'field_type' => $field_type, 
                'field_mandatory' => $field_mandatory,
                'field_seq' => $field_seq,  
                'app_name' => $app_name,
                'opening_text' => $opening_text,
                'closing_text' => $closing_text,
                'img_logo' => $img_logo,            
            );
            $this->dataaccess->update($this->table, $update, "row_id = '".$row_id."'");
            $data['msg'] = "Process successful";
            echo json_encode($data);
        }
    }

    public function form() {
        $state = $this->input->post("state");
        $row_id = $this->input->post("row_id");
        $idval=  $this->input->post("idval");
        $field_name = "";
        $field_value = "";
        $field_type = "";
        $field_mandatory = "";
        $field_seq = "";
        $app_name = "";
        $opening_text = "";
        $closing_text = "";
        $img_logo = "";
        $rs2 = $this->dataaccess->get($this->table, "1=1");
        if(!empty($rs2)) {
            $app_name = $rs2->app_name;
            $opening_text = $rs2->opening_text;
            $closing_text = $rs2->closing_text;
            $img_logo = $rs2->img_logo;
        }

        if($state == "edit") {
            $condition = "row_id = '".$row_id."'";
            $rs = $this->dataaccess->get($this->table, $condition);
            if(!empty($rs)) {
                $field_name = $rs->field_name;
                $field_value = $rs->field_value;
                $field_type = $rs->field_type;
                $field_mandatory = $rs->field_mandatory;
                $field_seq = $rs->field_seq;
                $app_name = $rs->app_name;
                $opening_text = $rs->opening_text;
                $closing_text = $rs->closing_text;
                $img_logo = $rs->img_logo;
            }
        }

        $selected_text = ($field_type == "Text") ? "selected" : "";
        $selected_textarea = ($field_type == "Textarea") ? "selected" : "";
        $selected_number = ($field_type == "Number") ? "selected" : "";
        $selected_money = ($field_type == "Money") ? "selected" : "";
        $selected_date = ($field_type == "Date") ? "selected" : "";
        $selected_checkbox = ($field_type == "CheckBox") ? "selected" : "";
        $selected_radiobutton = ($field_type == "Radio Button") ? "selected" : "";
        $selected_dropdownlist = ($field_type == "Dropdownlist") ? "selected" : "";
        $selected_title = ($field_type == "Title") ? "selected" : "";
        $selected_label = ($field_type == "Label") ? "selected" : "";
        $selected_label_bold = ($field_type == "Label Bold") ? "selected" : "";

        $selected_yes = ($field_mandatory == "Yes") ? "selected" : "";
        $selected_no = ($field_mandatory == "No") ? "selected" : "";

        Title,Label,Label Bold

        $type_list = '
                <option value="Text" '.$selected_text.'>Input Text</option>
                <option value="Textarea" '.$selected_textarea.'>Input Textarea</option>
                <option value="Number" '.$selected_number.'>Input Number</option>
                <option value="Money" '.$selected_money.'>Input Money</option>
                <option value="Date" '.$selected_date.'>Input Date</option>
                <option value="CheckBox" '.$selected_checkbox.'>CheckBox</option>
                <option value="Radio Button" '.$selected_radiobutton.'>Radio Button</option>
                <option value="Dropdownlist" '.$selected_dropdownlist.'>Dropdownlist</option>
                <option value="filechooser">File Chooser</option>
                <option value="Title" '.$selected_title.'>Title</option>
                <option value="Label" '.$selected_label.'>Label Text</option>
                <option value="Label Bold" '.$selected_label_bold.'>Label Text with Font Bold</option>
            ';

        $mandatory_list = '
                <option value="Yes"'.$selected_yes.'>Yes</option>
                <option value="No"'.$selected_no.'>No</option>
            ';

        $table = '
            <div class="row">
            <form method="POST" class="formInput" enctype="multipart/form-data">
              <input type="hidden" id="row_id" name="row_id" class="form-control" value="'.$row_id.'" style="background:#fff" readonly />
              <input type="hidden" id="state" name="state" class="form-control" value="'.$state.'" />
              <input type="hidden" id="app_name" name="app_name" class="form-control" value="'.$app_name.'" />
              <input type="hidden" id="opening_text" name="opening_text" class="form-control" value="'.$opening_text.'" />
              <input type="hidden" id="closing_text" name="closing_text" class="form-control" value="'.$closing_text.'" />
              <input type="hidden" id="img_logo" name="img_logo" class="form-control" value="'.$img_logo.'" />
              <input type="hidden" id="hdnval" name="hdnval" value="'.$idval.'" />
              <div class="col-md-12">
                <div class="form-group">
                  <label>Field Name: *</label>
                  <input type="text" id="field_name" name="field_name" class="form-control" value="'.$field_name.'" />
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Field Type: *</label>
                  <select id="field_type" name="field_type" class="form-control">
                    <option value=""></option>
                    '.$type_list.'
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Field Option value: </label><span style="font-size:11px"> (only for label, label bold, checkbox type and radio button type):</span>
                  <input type="text" id="field_value" name="field_value" class="form-control" value="'.$field_value.'" />
                  <span style="font-size:13px; color:#ff0000">using separator semicolon (;) for multiple data checkbox type and radio button type</span>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Mandatory: *</label>
                  <select id="field_mandatory" name="field_mandatory" class="form-control">
                    <option value=""></option>
                    '.$mandatory_list.'
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Sequence: *</label>
                  <input type="number" id="field_seq" name="field_seq" class="form-control" value="'.$field_seq.'" />
                </div>
              </div>
             
            </form> 
            </div>
        ';

        $data['table'] = $table;
        echo json_encode($data);
    }

    public function view() {
        $row_id = $this->input->post("row_id");
        $field_name = "";
        $field_value = "";
        $field_type = "";
        $field_mandatory = "";
        
        $condition = "row_id = '".$row_id."'";
        $rs = $this->dataaccess->get($this->table, $condition);
        if(!empty($rs)) {
            $field_name = $rs->field_name;
            $field_value = $rs->field_value;
            $field_type = $rs->field_type;
            $field_mandatory = $rs->field_mandatory;
        }        

        $table = '
            <table id="tablelist" class="table table-striped">
              <tbody>
                <tr>
                    <td style="width:25%" class="view-title">Field Name:</td>
                    <td class="view-txt">'.$field_name.'</td>
                </tr>
                <tr>
                    <td class="view-title">Field Type:</td>
                    <td class="view-txt">'.$field_type.'</td>
                </tr>
                <tr>
                    <td class="view-title">Field Option value <BR>(for type checkbox and radio button):</td>
                    <td class="view-txt">'.$field_value.'</td>
                </tr>
                <tr>
                    <td class="view-title">Mandatory:</td>
                    <td class="view-txt">'.$field_mandatory.'</td>
                </tr>
                <tr>
                    <td class="view-title">Sequence:</td>
                    <td class="view-txt">'.$field_seq.'</td>
                </tr>
              </tbody>
            </table>
        ';

        $data['table'] = $table;
        echo json_encode($data);
    }

    public function delete(){
        $row_id = $this->input->post("row_id");

        $condition = "row_id = '".$row_id."'";
        $this->dataaccess->delete($this->table, $condition);

        $condition = "field_id = '".$row_id."'";
        $this->dataaccess->delete('dataform', $condition);
        $data['msg'] = "Process successful";
        echo json_encode($data);
    }

    public function clear() {
        $this->dataaccess->truncate('dataform');
        $this->dataaccess->truncate('dynamicfield');

        $insert = array(
            'field_name' => 'Title',
            'field_type' => 'Title',
            'field_value' => 'Customer Form',
            'field_mandatory' => 'No',
            'field_seq' => '1',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Vendor Name',
            'field_type' => 'Text',
            'field_value' => '',
            'field_mandatory' => 'Yes',
            'field_seq' => '2',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Member',
            'field_type' => 'Dropdownlist',
            'field_value' => 'Platinum;Gold;Silver;Iron',
            'field_mandatory' => 'Yes',
            'field_seq' => '3',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Address',
            'field_type' => 'Textarea',
            'field_value' => '',
            'field_mandatory' => 'Yes',
            'field_seq' => '4',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Title 2',
            'field_type' => 'Title',
            'field_value' => 'Payment Form',
            'field_mandatory' => 'No',
            'field_seq' => '5',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Transaction Date',
            'field_type' => 'Date',
            'field_value' => '',
            'field_mandatory' => 'No',
            'field_seq' => '6',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Item',
            'field_type' => 'CheckBox',
            'field_value' => 'Warranty;Service;Delivery;Assembly',
            'field_mandatory' => 'Yes',
            'field_seq' => '7',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Qty',
            'field_type' => 'Number',
            'field_value' => '',
            'field_mandatory' => 'Yes',
            'field_seq' => '8',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Amount',
            'field_type' => 'Money',
            'field_value' => '',
            'field_mandatory' => 'Yes',
            'field_seq' => '9',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'VAT',
            'field_type' => 'Radio Button',
            'field_value' => '10%;20%;30%',
            'field_mandatory' => 'Yes',
            'field_seq' => '10',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Term Condition',
            'field_type' => 'Label',
            'field_value' => 'Term & condition: 1% discount if payment received within ten days otherwise payment 30 days after in',
            'field_mandatory' => 'No',
            'field_seq' => '11',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        $insert = array(
            'field_name' => 'Thanks',
            'field_type' => 'Label Bold',
            'field_value' => 'After submitting, our team will contact you soon. Thank you!',
            'field_mandatory' => 'No',
            'field_seq' => '12',
            'app_name' => 'Dynamic Form',
            'opening_text' => 'Hi, welcome to dynamic form. This is a form android application that can configured to suit your needs. Please do the testing and dont forget to buy this product!',
            'closing_text' => 'thank you very much for testing, remember all the data that you input is stored in the backend database server. And once more, dont forget to buy this product!',
            'img_logo' => 'logo.png',
        );
        $this->dataaccess->insert('dynamicfield', $insert);

        redirect(site_url("definefield"));
    }
}	