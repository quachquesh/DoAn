<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_modal extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function online($data)
	{
		$this->db->insert('order_done', $data);
		return $this->db->insert_id();
	}

	public function onlinePayment($data)
	{
		return $this->db->insert('order_payment', $data);
	}

	public function offline($data)
	{
		$this->db->insert('order_wait', $data);
		return $this->db->insert_id();
	}
}

/* End of file Order.php */
/* Location: ./application/models/Order.php */