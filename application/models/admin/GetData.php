<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetData extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getAccountAdmin($id = -1)
	{
		$this->db->select('*');
		if ($id != -1) {
			$this->db->where('userId', $id);
		}
		return $this->db->get('admins')->result_array();
	}

	public function getDuty()
	{
		$this->db->select('*');
		return $this->db->get('admin_duty_level')->result_array();
	}

	public function getProduct($id = -1)
	{
		$this->db->select('*');
		if ($id != -1) {
			$this->db->where('id', $id);
		}
		return $this->db->get('product')->result_array();
	}

	public function getProductAvtByType($type)
	{
		$this->db->select('avt');
		$this->db->where('typeCode', $type);
		return $this->db->get('product')->result_array();
	}

	public function getProductType($code = "")
	{
		$this->db->select('*');
		if ($code != "") {
			$this->db->where('code', $code);
		}
		return $this->db->get('product_type')->result_array();
	}

	public function getStore($code = -1)
	{
	    $this->db->select('*');
	    if ($code != -1)
	    	$this->db->where('code', $code);
	    return $this->db->get('stores')->result_array();
	}

	public function getOrderHistory()
	{
		$this->db->select('*');
		return $this->db->get('order_history')->result_array();
	}

	public function getOffline($id = -1)
	{
		$this->db->select('*');
		if ($id !== -1)
			$this->db->where('id', $id);
		return $this->db->get('order_wait')->result_array();
	}
	
	public function getOnline($id = -1)
	{
		$this->db->select('*');
		if ($id !== -1)
			$this->db->where('id', $id);
		return $this->db->get('order_done')->result_array();
	}
}

/* End of file GetData.php */
/* Location: ./application/models/GetData.php */