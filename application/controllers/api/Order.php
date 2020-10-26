<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Order_modal');
	}

	public function index()
	{
		
	}

	public function online($id = -1)
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'POST') {
			if ($id == -1) {
				$data['productList'] = json_encode($this->input->post('product'));
				$data['price'] = $this->input->post('price');
				$data['note'] = $this->input->post('note');
				$data['tableId'] = $this->input->post('table');
				$data['storeId'] = $this->input->post('store');
				
				if ($this->Order_modal->online($data)) {
					$res['status'] = true;
					$res['message'] = 'Thanh toán thành công';
				} else {
					$res['status'] = false;
					$res['message'] = 'Thanh toán thất bại';
				}

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($res))
		        ->set_status_header(201);
			}
			if ($id != -1) {
				$this->load->model('admin/OrderManager');
				if ($this->OrderManager->applyOrderOnline($id)) {
					$res['status'] = true;
					$res['message'] = 'Thanh toán thành công';
				} else {
					$res['status'] = false;
					$res['message'] = 'Thanh toán thất bại';
				}

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($res))
		        ->set_status_header(201);
			}
		}
	}

	public function onlinePayment($id = -1)
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'POST') {
			if ($id === -1) {
				$data['id'] = $this->input->post('id');
				$data['productList'] = json_encode($this->input->post('product'));
				$data['price'] = $this->input->post('price');
				$data['note'] = $this->input->post('note');
				$data['tableId'] = $this->input->post('table');
				$data['storeId'] = $this->input->post('store');
				
				if ($this->Order_modal->onlinePayment($data)) {
					$res['status'] = true;
					$res['message'] = 'Tạo hóa đơn thành công';
				} else {
					$res['status'] = false;
					$res['message'] = 'Tạo hóa đơn thất bại';
				}

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($res))
		        ->set_status_header(201);
			}
		}
	}

	public function offline($id = -1)
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'POST') {
			if ($id === -1) {
				$data['productList'] = json_encode($this->input->post('product'));
				$data['price'] = $this->input->post('price');
				$data['note'] = $this->input->post('note');
				$data['tableId'] = $this->input->post('table');
				$data['storeId'] = $this->input->post('store');
				
				if ($this->Order_modal->offline($data)) {
					$res['status'] = true;
					$res['message'] = 'Đặt hàng thành công';
				} else {
					$res['status'] = false;
					$res['message'] = 'Đặt hàng thất bại';
				}

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($res))
		        ->set_status_header(201);
			}
		}
	}
}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */