<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DeleteType extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('menuManager')){
			$this->output->set_status_header(500);
			exit();
		} else {
			$this->load->model('admin/MenuManager');
			$this->load->model('admin/GetData');
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'POST') {
			$code = $this->input->post('code');

			$arrAvt = $this->GetData->getProductAvtByType($code);
			if ($this->MenuManager->deleteProductType($code)) {
				foreach ($arrAvt as $value) {
				    unlink($value['avt']);
				}
				$res['status'] = true;
				$res['message'] = 'Xóa <b style="text-transform: uppercase;">'.$code.'</b> thành công';
			} else {
				$res['status'] = false;
				$res['message'] = 'Xóa <b style="text-transform: uppercase;">'.$code.'</b> thất bại';
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

/* End of file DeleteType.php */
/* Location: ./application/controllers/DeleteType.php */