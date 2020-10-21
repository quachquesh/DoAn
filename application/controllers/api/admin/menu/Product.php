<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('menuManager')){
			$this->output->set_status_header(500);
			exit();
		} else {
			$this->load->model('admin/GetData');
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			$res = $this->GetData->getProduct();

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function id($id)
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			$res = $this->GetData->getProduct($id);

			if (!$res) {
				$res['status'] = false;
				$res['message'] = 'Không tìm thấy thông tin';
			} else if ($id != -1) {
				$res = $res[0];
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

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */