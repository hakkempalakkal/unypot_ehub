<?php	
	function rplc_for_url($data)
    {                
		$value = strtolower(str_replace(" ", "-", str_replace("'", " ", str_replace("?", " ", str_replace("!", " ", str_replace(",", " ", str_replace(".", " ", $data)))))));
		return $value;
    }	
    
    function left($str, $length) {
        return substr($str, 0, $length);
    }

    function right($str, $length) {
        return substr($str, -$length);
    }
	
	function indonesian_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') 
    {
        if (trim ($timestamp) == '')
        {
            $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
            $timestamp = strtotime ($timestamp);
        }
        
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace ("/S/", "", $date_format);
        
        $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
        );
        
        $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Januari ','Februari ','Maret ','April ','Mei ','Juni ','Juli ','Agustus ','September ',
            'Oktober ','November ','Desember ',
            'Januari ','Februari ','Maret ','April ','Juni ','Juli ','Agustus ','September ',
            'Oktober ','November ','Desember ',
        );
        
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        return $date;
    }
	
	function upload($filename, $path, $entity)
    {
		$ci =& get_instance();			
		
        $config = array(
			//'upload_path' => "uploads/employee/",
			'upload_path' => $path,
			'allowed_types' => "gif|jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "5048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'file_name' => $filename
        );
        
        $ci->upload->initialize($config);
        if($ci->upload->do_upload($entity))
        {
            $data = array('upload_data' => $ci->upload->data());
            return true;
        }
        else
        {
            $error = array('error' => $ci->upload->display_errors());
            echo json_encode($error);
        }
    }
	
	function islogin()
	{
		$ci =& get_instance();		
		
        if(!isset($ci->session->userdata['SessionLogin']['SesIsLogin']))
        {
            redirect(site_url("login")."?msg=Please login first");
		}
	}
	
	function hapuskoma($data)
	{
		return str_replace(",", "", $data);
	}
	
	function getatributpopup($width, $height, $class)
    {
        return array(
            'width'      => $width,
            'height'     => $height,
            'scrollbars' => 'yes',
            'status'     => 'yes',
            'resizable'  => 'yes',
            'screenx'    => '0',
            'screeny'    => '0',
            'class'      => $class,
            'align'  => 'center'
            );
    }
	
	function getatributpopup_small()
    {
        return array(
            'width'      => '500',
            'height'     => '300',
            'scrollbars' => 'yes',
            'status'     => 'yes',
            'resizable'  => 'yes',
            'screenx'    => '0',
            'screeny'    => '0',
            'class'      => 'btn btn-sm btn-inverse',
            'align'  => 'center'
            );
    }
	
	function getatributpopup_nonclass()
    {
        return array(
            'width'      => '1100',
            'height'     => '600',
            'scrollbars' => 'yes',
            'status'     => 'yes',
            'resizable'  => 'yes',
            'screenx'    => '0',
            'screeny'    => '0',
            'align'  => 'center',
			'class' => 'hyperlink'
            );
    }

    function myurlencode($str)
    {
        $str = base64_encode($str);
        $str = rtrim($str, '=');
        $str = urlencode($str);
        return $str;
    }


    function myurldecode($str)
    {
        $str = $str.str_repeat('=', strlen($str) % 4);
        $str = base64_decode($str);
        $str = urldecode($str);
        return $str;
    }

    function getByQuery($qry)
    {
        $ci =& get_instance();      
        return $ci->dataaccess_mdl->getByQuery($qry);        
    }

    function insertData($table, $data) {
        $ci =& get_instance();   
        return $ci->dataaccess_mdl->insert($table, $data);
    }

    function updateData($table, $data, $where) {
        $ci =& get_instance();   
        return $ci->dataaccess_mdl->update($table, $data, $where);
    }

    function deleteData($table, $where) {
        $ci =& get_instance();   
        return $ci->dataaccess_mdl->delete($table, $where);
    }

    function userName(){
        $ci =& get_instance();           
        return $ci->session->userdata['SessionLogin']['SesUserName'];
    }

    function userId(){
        $ci =& get_instance();           
        return $ci->session->userdata['SessionLogin']['SesUserId'];
    }

    function uploadFile($file, $file_name, $allowed_types){
        $ci =& get_instance();

        $config['upload_path'] = 'folder/cv/';
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        $config['file_name'] = $file_name;
 
        $ci->load->library('upload', $config);
 
        $ci->upload->do_upload($file);
        $ci->upload->data();
    }

    function getPermission($controller) {
        $ci =& get_instance();  
        $role_id = $ci->session->userdata['SessionLogin']['SesRoleId'];
        $condition = "role_id = '".$role_id."' and controller = '".$controller."'";
        $rs = $ci->dataaccess->get("vw_sysmenuassign", $condition);
        return $rs->role_type;
    }
	
?>