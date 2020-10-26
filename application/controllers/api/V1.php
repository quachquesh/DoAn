<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class V1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/GetData');
	}

	public function index()
	{
		
	}

	// Sản phẩm
	public function product($id = -1)
	{
		// Kiểm tra phương thức
		$method = $this->input->server('REQUEST_METHOD');

		if ($method == "GET") { // [GET] Lấy dữ liệu
			if ($id == -1) {
				$res = $this->GetData->getProduct();
			} else {
				$res = $this->GetData->getProduct($id);

				if (!$res) {
					$res['status'] = false;
					$res['message'] = 'Không tìm thấy thông tin';
				} else {
					$res = $res[0];
				}
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}
}

/* End of file Ssm.php */
/* Location: ./application/controllers/Ssm.php */