<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getduty extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level') || $this->session->userdata('level') > 2 || $this->session->userdata('level') < 1){
			echo "Không đủ quyền";
			die();
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			$this->load->model('admin/GetData');
			$data = $this->GetData->getDuty();
			foreach ($data as $key => $value) {
				$level[$key] = $value['level'];
			}
			array_multisort($data, SORT_ASC, $level);
			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data))
	        ->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

}

/* End of file GetDuty.php */
/* Location: ./application/controllers/GetDuty.php */