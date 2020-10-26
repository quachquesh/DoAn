<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/GetData');
	}

	public function index()
	{
		$data = $this->GetData->getOffline();
		$data = array('data' => $data);
		$this->load->view('admin/OrderManager/main', $data, false);
	}

	public function OrderWait()
	{
		$data = $this->GetData->getOffline();
		$data = array('data' => $data);
		$this->load->view('admin/OrderManager/orderWait', $data, false);
	}

	public function OrderDone()
	{
		$data = $this->GetData->getOnline();
		foreach ($data as $key => $value) {
		    $data[$key]['productList'] = json_decode($value['productList']);
		}
		$data = array('data' => $data);
		$this->load->view('admin/OrderManager/orderDone', $data, false);
	}
}

/* End of file OrderManager.php */
/* Location: ./application/controllers/OrderManager.php */