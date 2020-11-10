<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderManager extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function applyOrderOffline($id)
	{
		$data = array('status' => 2);
		$this->db->where('id', $id);
		return $this->db->update('orders', $data);
	}

	public function applyOrderOnline($id)
	{
		$data = array('status' => 3);
		$this->db->where('id', $id);
		return $this->db->update('orders', $data);
	}

	public function applyOrderSuccess($id)
	{
		$data = array('status' => 4);
		$this->db->where('id', $id);
		return $this->db->update('orders', $data);
	}

	public function deleteOrder($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('orders');
	}
	
	public function OrderConfirm($id)
	{
		$data = array('status' => 2);
		$this->db->select('*');
		$this->db->where('id', $id);
		if ($this->db->get('orders')->result_array()){
			$this->db->where('id', $id);
			return $this->db->update('orders', $data);
		} else {
			return false;
		}
	}
}

/* End of file OrderManager.php */
/* Location: ./application/models/OrderManager.php */