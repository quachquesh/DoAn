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

	public function getMenu()
	{
		$this->db->select('*');
		return $this->db->get('menu')->result_array();
	}

	public function getMenuDiscountType()
	{
		$this->db->select('*');
		return $this->db->get('menu_discount_type')->result_array();
	}

	public function getMenuType()
	{
		$this->db->select('*');
		return $this->db->get('menu_type')->result_array();
	}
}

/* End of file GetData.php */
/* Location: ./application/models/GetData.php */