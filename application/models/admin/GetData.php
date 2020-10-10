<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetData extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getDuty()
	{
		$this->db->select('*');
		return $this->db->get('admin_duty_level')->result_array();
	}
}

/* End of file GetData.php */
/* Location: ./application/models/GetData.php */