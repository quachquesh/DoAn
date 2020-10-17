<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateType extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('menuManager')){
			$this->output->set_status_header(500);
			exit();
		} else {
			$this->load->model('admin/MenuManager');
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'POST') {
			$data['code'] = $this->input->post('code');
			$data['typeName'] = $this->input->post('typeName');
			$data['business'] = $this->input->post('business');
			
			$data['code'] = str_replace(" ", "", $data['code']);
			$data['code'] = strtolower($data['code']);

			if ($this->MenuManager->createProductType($data)) {
				$res['status'] = true;
				$res['message'] = 'Thêm <b>'.$data['code'].'</b> thành công';
			} else {
				$res['status'] = false;
				$res['message'] = 'Thêm <b>'.$data['code'].'</b> thất bại';
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

/* End of file CreateType.php */
/* Location: ./application/controllers/CreateType.php */