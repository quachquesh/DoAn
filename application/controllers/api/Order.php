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
				$data['price'] = $this->input->post('price');
				$data['note'] = $this->input->post('note');
				$data['tableId'] = $this->input->post('table');
				$data['voucher'] = $this->input->post('voucher');
				$this->load->model('admin/VoucherManager');
				$this->VoucherManager->useVoucherCount($data['voucher']);
				
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
				$data['price'] = $this->input->post('price');
				$data['note'] = $this->input->post('note');
				$data['tableId'] = $this->input->post('table');
				$data['voucher'] = $this->input->post('voucher');
				$this->load->model('admin/VoucherManager');
				$this->VoucherManager->useVoucherCount($data['voucher']);

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
				$cartPrice = $this->input->post('cartPrice');
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
						$res['code'] = $voucher['code'];
						$res['cartPrice_old'] = $cartPrice;

						if ($voucher['discountType']){
							$res['cartPrice_new'] = $cartPrice - $voucher['discountValue'];
							$res['cartPrice_discount'] = $voucher['discountValue'];
						} else {
							$res['cartPrice_discount'] = $cartPrice/100*$voucher['discountValue'];
							$res['cartPrice_new'] = $cartPrice - $res['cartPrice_discount'];
						}

						if ($res['cartPrice_new'] < 0) {
							$res['cartPrice_new'] = 0;
							$res['cartPrice_discount'] = $cartPrice;
						}
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