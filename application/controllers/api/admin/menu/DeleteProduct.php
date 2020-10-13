<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DeleteProduct extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('menuManager')){
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/MenuManager');
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'POST') {

			$id = $this->input->post('product-id');
			$res['status'] = false;

			$this->load->model('admin/GetData');
			$data = $this->GetData->getMenu($id);
			if ($data) {
				if ($this->MenuManager->deleteProduct($id)) {
					unlink($data[0]['avt']);
					$res['status'] = true;
					$res['message'] = 'Xóa thành công';
				}
			} 

			if ($res['status'] == false) {
				$res['message'] = 'Xóa thất bại';
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

/* End of file DeleteProduct.php */
/* Location: ./application/controllers/DeleteProduct.php */