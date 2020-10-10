<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('accountManager')) {
			$this->output->set_status_header(500);
			die();
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'PUT') {
			$this->load->model('admin/GetData');
			$data = $this->GetData->getDuty();
			foreach ($data as $key => $value) {
				$level[$key] = $value['level'];
			}
			array_multisort($data, SORT_ASC, $level);

			$adminLevel = $this->session->userdata('level');
			if ($adminLevel != 1) {
				foreach ($data as $key => $value) {
					if ($value['level'] > $adminLevel) {
						break;
					}
					unset($data[$key]);
				}
			}

			$data = array('duty' => $data);
			$this->load->view('admin/createAccount_view', $data, FALSE);

			$this->output->set_status_header(201);
		} else {
			$this->output->set_status_header(500);
		}
	}

}

/* End of file AccountManager.php */
/* Location: ./application/controllers/AccountManager.php */