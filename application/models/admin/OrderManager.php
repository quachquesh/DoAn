<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderManager extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function applyOrderOffline($id)
	{
		$sql = "INSERT INTO order_done (order_done.productList, order_done.price, order_done.note, order_done.tableId, order_done.storeId)
				SELECT order_wait.productList, order_wait.price, order_wait.note, order_wait.tableId, order_wait.storeId
				FROM order_wait
				WHERE order_wait.id = '$id';";
		$sql2 = "DELETE FROM order_wait WHERE order_wait.id = '$id';";
		$this->db->trans_start();
		$this->db->query($sql);
		$this->db->query($sql2);
		return $this->db->trans_complete();
	}

	public function deleteOrderOffline($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('order_wait');
	}
	
	public function applyOrderOnline($id)
	{
		$sql = "INSERT INTO order_done (order_done.productList, order_done.price, order_done.note, order_done.tableId, order_done.storeId)
				SELECT order_payment.productList, order_payment.price, order_payment.note, order_payment.tableId, order_payment.storeId
				FROM order_payment
				WHERE order_payment.id = '$id';";
		$sql2 = "DELETE FROM order_payment WHERE order_payment.id = '$id';";
		$this->db->trans_start();
		$this->db->query($sql);
		$this->db->query($sql2);
		return $this->db->trans_complete();
	}

	public function deleteOrderOnline($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('order_done');
	}
}

/* End of file OrderManager.php */
/* Location: ./application/models/OrderManager.php */