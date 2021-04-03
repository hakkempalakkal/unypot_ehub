<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dataform extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        $this->condb  = $this->load->database('default', TRUE);
    }

    public function index() {
		$data = array(
			'count_field' => $this->dataaccess->get_count("dynamicfield", "field_type not in ('Title','Label','Label Bold')"),
			'dataform_list' => $this->dataaccess->select("vw_dataform", "field_type not in ('Title','Label','Label Bold')"),
			'dynamicfield_list' => $this->dataaccess->select("dynamicfield", "field_type not in ('Title','Label','Label Bold')", array('field_seq' => 'asc')),
		);
        $this->layout->display('page/dataform_vw', $data);
    }
}	