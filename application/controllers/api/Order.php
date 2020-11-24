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
			if ($id != -1) {
				$this->load->model('admin/OrderManager');
				if ($this->OrderManager->OrderConfirm($id)) {
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
				$data['productList'] = $this->input->post('product');
				$data['priceOrder'] = $this->input->post('priceOrder');
				$data['priceDiscount'] = $this->input->post('priceDiscount');
				$data['pricePayment'] = $this->input->post('pricePayment');
				$data['note'] = $this->input->post('note');
				$data['tableId'] = $this->input->post('table');

				if ($this->input->post('voucher') != 0) {
					$data['voucher'] = $this->input->post('voucher');
					$this->load->model('admin/VoucherManager');
					$this->VoucherManager->useVoucherCount($data['voucher']);
				}
				$data['payment'] = 1;
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
				$data['id'] = $this->input->post('id');
				$data['productList'] = $this->input->post('product');
				$data['priceOrder'] = $this->input->post('priceOrder');
				$data['priceDiscount'] = $this->input->post('priceDiscount');
				$data['pricePayment'] = $this->input->post('pricePayment');
				$data['note'] = $this->input->post('note');
				$data['tableId'] = $this->input->post('table');

				if ($this->input->post('voucher') != 0) {
					$data['voucher'] = $this->input->post('voucher');
					$this->load->model('admin/VoucherManager');
					$this->VoucherManager->useVoucherCount($data['voucher']);
				}
				$data['payment'] = 2;
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

	public function voucher()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$code = $this->input->post('code');

			$this->load->helper('Validator');
			if (isRequired($code)) {
				$res['status'] = false;
				$res['message'] = 'Chưa nhập mã khuyến mãi';
			}

			if (!isset($res['status'])) {
				$this->load->model('admin/GetData');

				$voucher = $this->GetData->getVoucherByCode($code);
				if ($voucher) {
					$timeNow = strtotime("now")+21600;
					if ($voucher['timeStart'] > $timeNow) {
						$res['status'] = false;
						$res['message'] = 'Chưa đến thời gian khuyến mãi';
					} else if ($voucher['timeEnd'] < $timeNow) {
						$res['status'] = false;
						$res['message'] = 'Mã khuyến mãi đã hết hạn';
					} else if ($voucher['count'] < 1 && $voucher['count'] != -999) {
						$res['status'] = false;
						$res['message'] = 'Mã khuyến mãi đã hết lượt sử dụng';
					} else {
						$res['status'] = true;
						$res['id'] = $voucher['id'];
						$res['code'] = $voucher['code'];
						$res['discountType'] = $voucher['discountType'];
						$res['discountValue'] = $voucher['discountValue'];
					}
				} else {
					$res['status'] = false;
					$res['message'] = 'Mã khuyến mãi không tồn tại';
				}
			}
			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		}
	}
}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */