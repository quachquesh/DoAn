<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/GetData');
	}

	public function index()
	{
		$store = $this->GetData->getStore($_GET['StoreId']);

		if ($store) {
			$product = $this->GetData->getProduct();
			$productType = $this->GetData->getProductType();
			$store = $store[0];
			$data = array(
				'product' => $product,
				'productType' => $productType,
				'store' => $store,
				'table' => $_GET['TableId'],
			);
			if (isset($_GET['errorCode']) && isset($_GET['orderType'])) {
				$data['momo'] = $this->input->get();
			}
			$this->load->view('order', $data, false);
		} else {
			$this->output->set_status_header(500);
		}
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */