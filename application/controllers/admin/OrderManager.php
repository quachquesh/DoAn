<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/GetData');
	}

	public function index()
	{
		$data = $this->GetData->getOrderOffline();
		$data = array('data' => $data);
		$this->load->view('admin/OrderManager/main', $data, FALSE);
	}

	public function OrderWait()
	{
		$data = $this->GetData->getOrderOffline();
		$data = array('data' => $data);
		$this->load->view('admin/OrderManager/orderWait', $data, false);
	}

	public function OrderDone()
	{
		$orders = $this->GetData->getOrderOnline();
		$order_details = $this->GetData->getOrderDetail();
		foreach ($orders as $key => $value) {
			foreach ($order_details as $key2 => $value2) {
				if ($value['id'] == $value2['orderId']) {
					$orders[$key]['product'][] = $value2;
					unset($order_details[$key2]);
				}
			}
		}
		$product = $this->GetData->getProduct();
		foreach ($product as $key => $value) {
			$data[$value['id']] = $value;
		}
		$product = $data;

		foreach ($orders as $key => $value) {
			foreach ($value['product'] as $key2 => $value2) {
				$orders[$key]['product'][$key2]['product'] = $product[$value2['productId']];
			}
		}
		$data = array('data' => $orders);
		$this->load->view('admin/OrderManager/orderDone', $data, false);
	}

	public function OrderSuccess()
	{
		$data = $this->GetData->getOrderSuccess();
		$data = array('data' => $data);
		$this->load->view('admin/OrderManager/OrderSuccess', $data, false);
	}
}

/* End of file OrderManager.php */
/* Location: ./application/controllers/OrderManager.php */