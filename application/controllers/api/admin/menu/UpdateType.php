<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UpdateType extends CI_Controller {

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
			$code = $this->input->post('code');
			$data = array(
				'typeName' => $this->input->post('typeName'),
				'business' => $this->input->post('business')
			);
			$res['status'] = $this->MenuManager->updateProductType($code, $data);
			if ($res['status']) {
				$res['message'] = 'Cập nhật <b style="text-transform: uppercase;">'.$code.'</b> thành công';
			} else {
				$res['message'] = 'Cập nhật <b style="text-transform: uppercase;">'.$code.'</b> thất bại';
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

/* End of file UpdateType.php */
/* Location: ./application/controllers/UpdateType.php */